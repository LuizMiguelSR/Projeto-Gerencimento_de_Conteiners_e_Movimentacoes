<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimentacao;
use App\Models\Container;
use Illuminate\Support\Facades\DB;

class MovimentacaoController extends Controller
{
    public function create()
    {
        $containers = Container::all();
        return view('nova_movimentacao', compact('containers'));
    }

    public function store(Request $request)
    {
        $dataMovimentacao = $request->validate([
            'container_id' => 'required|integer',
            'tipo' => 'required|in:Embarque,Descarga,Gate in,Gate out,Reposicionamento,Pesagem,Scanner',
            'data_hora_inicio' => 'required|date_format:Y-m-d\TH:i',
            'data_hora_fim' => 'required|date_format:Y-m-d\TH:i',
        ]);
        $movimentacao = Movimentacao::create([
            'container_id' => $dataMovimentacao['container_id'],
            'tipo' => $dataMovimentacao['tipo'],
            'data_hora_inicio' => $dataMovimentacao['data_hora_inicio'] . ":00",
            'data_hora_fim' => $dataMovimentacao['data_hora_fim'] . ":00",
        ]);
        return redirect()->route('movimentacoes.create');
    }

    public function movimentacoes_ordenar_container(Request $request)
    {
        if ($request->nome === 'ASC') {
            $containers = Container::orderBy('cliente', 'ASC')->get();
            return view('nova_movimentacao', compact('containers'));
        }
        if ($request->nome === 'DESC') {
            $containers = Container::orderBy('cliente', 'DESC')->get();
            return view('nova_movimentacao', compact('containers'));
        }
        if (empty($request->nome)) {
            return redirect()->route('movimentacoes.create');
        }
    }

    public function filtrar_container(Request $request)
    {
        $query = Container::query()
        ->when($request->cliente, function($query, $cliente){
            return $query->where('cliente', 'LIKE', '%' . $cliente . '%');
        })
        ->when($request->numero_container, function($query, $numero_container){
            return $query->where('numero_container', 'LIKE', '%' . $numero_container . '%');
        });
        $containers = $query->get();
        return view('nova_movimentacao', compact('containers'));
    }


    public function index()
    {
        $movimentacoes = Movimentacao::with('container.cliente')->get();
        return view('gerenciar_movimentacao', compact('movimentacoes'));
    }

    public function movimentacoes_ordenar_movimentacao(Request $request)
    {
        if ($request['nome'] === 'ASC') {
            $movimentacoes = Movimentacao::with('container.cliente')->get();
            $movimentacoes = $movimentacoes->sortBy('container.cliente');
            return view('gerenciar_movimentacao', compact('movimentacoes'));
        }
        if ($request['nome'] === 'DESC') {
            $movimentacoes = Movimentacao::with('container.cliente')->get();
            $movimentacoes = $movimentacoes->sortByDesc('container.cliente');
            return view('gerenciar_movimentacao', compact('movimentacoes'));
        }
    }

    public function update(Request $request, $id)
    {
        $dataMovimentacao = $request->validate([
            'tipo' => 'required|in:Embarque,Descarga,Gate in,Gate out,Reposicionamento,Pesagem,Scanner',
            'data_hora_inicio' => 'required|date_format:Y-m-d\TH:i',
            'data_hora_fim' => 'required|date_format:Y-m-d\TH:i',
        ]);
        $movimentacao = Movimentacao::findOrFail($id);
        $movimentacao->update([
            'tipo' => $dataMovimentacao['tipo'],
            'data_hora_inicio' => $dataMovimentacao['data_hora_inicio'] . ':00',
            'data_hora_fim' => $dataMovimentacao['data_hora_fim'] . ':00',
        ]);
        return redirect()->route('movimentacoes.index');
    }

    public function destroy($id)
    {
        Movimentacao::destroy($id);
        return redirect()->route('movimentacoes.index');
    }

    public function filtrar_movimentacao(Request $request)
    {
        $query = Movimentacao::query()
            ->when($request->cliente, function ($query, $cliente) {
                return $query->whereHas('container', function ($query) use ($cliente) {
                    return $query->where('cliente', 'LIKE', '%' . $cliente . '%');
                });
            })
            ->when($request->numero_container, function($query, $numero_container) {
                return $query->whereHas('container', function($query) use ($numero_container) {
                    return $query->where('numero_container','LIKE', '%' . $numero_container . '%');
                });
            })
            ->when($request->tipo, function ($query, $tipo) {
                return $query->where('tipo', $tipo);
            })
            ->when($request->data_hora_inicio, function($query, $data_hora_inicio) {
                return $query->where('data_hora_inicio', $data_hora_inicio);
            })
            ->when($request->data_hora_fim, function($query, $data_hora_fim) {
                return $query->where('data_hora_fim', $data_hora_fim);
            });

        $movimentacoes = $query->get();

        return view('gerenciar_movimentacao', compact('movimentacoes'));
    }

    public function relatorio()
    {
        $movimentacoes = DB::select('
            SELECT c.cliente, COUNT(*) as total,
                SUM(CASE WHEN c.categoria = "Importação" THEN 1 ELSE 0 END) as total_importacao,
                SUM(CASE WHEN c.categoria = "Exportação" THEN 1 ELSE 0 END) as total_exportacao
            FROM container c
            JOIN movimentacao m ON c.id = m.container_id
            GROUP BY c.cliente
        ');

        return view('relatorio', ['movimentacoes' => $movimentacoes]);
    }
}
