<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Container;
use App\Models\Movimentacao;
use Illuminate\Support\Facades\DB;

class ControllerMovimentacao extends Controller
{
    public function create()
    {
        $containers = Container::all();
        return view('nova_movimentacao', compact('containers'));
    }

    public function filtrar_container(Request $request)
    {
        $query = Container::query()
        ->when($request->cliente, function ($query, $cliente){
            return $query->where('cliente', 'LIKE', '%' . $cliente . '%');
        })
        ->when($request->numero_container, function ($query, $numero_container){
            return $query->where('numero_container', 'LIKE', '%' . $numero_container . '%');
        });
        $containers = $query->get();
        return view('nova_movimentacao', compact('containers'));
    }

    public function store(Request $request)
    {
        $dataMovimentacao = $request->validate([
            'container_id' => 'required|integer',
            'tipo' => 'required|in:Embarque,Descarga,Gate in,Gate out,Reposicionamento,Pesagem,Scanner',
            'data_hora_inicio' => 'required|date_format:Y-m-d\TH:i',
            'data_hora_fim' => 'required|date_format:Y-m-d\TH:i'
        ]);

        $movimentacao = Movimentacao::create([
            'container_id' => $dataMovimentacao['container_id'],
            'tipo' => $dataMovimentacao['tipo'],
            'data_hora_inicio' => $dataMovimentacao['data_hora_inicio'] . ':00',
            'data_hora_fim' => $dataMovimentacao['data_hora_fim'] . ':00',
        ]);

        return redirect()->route('movimentacoes.create');
    }

    public function index()
    {
        $movimentacoes = Movimentacao::with('container.cliente')->get();
        return view('gerenciar_movimentacao', compact('movimentacoes'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tipo' => 'required|in:Embarque,Descarga,Gate in,Gate out,Reposicionamento,Pesagem,Scanner',
            'data_hora_inicio' => 'required|date_format:Y-m-d\TH:i',
            'data_hora_fim' => 'required|date_format:Y-m-d\TH:i',
        ]);
        $movimentacao = Movimentacao::findOrFail($id);
        $movimentacao->update([
            'tipo' => $data['tipo'],
            'data_hora_inicio' => $data['data_hora_inicio'] . ':00',
            'data_hora_fim' => $data['data_hora_fim'] . ':00',
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
            ->when($request->numero_container, function ($query, $numero_container) {
                return $query->whereHas('container', function ($query) use ($numero_container) {
                    return $query->where('numero_container', 'LIKE', '%' . $numero_container . '%');
                });
            })
            ->when($request->tipo, function ($query, $tipo) {
                return $query->where('tipo', $tipo);
            })
            ->when($request->data_hora_inicio, function ($query, $data_hora_inicio) {
                return $query->where('data_hora_inicio', $data_hora_inicio);
            })
            ->when($request->data_hora_fim, function ($query, $data_hora_fim) {
                return $query->where('data_hora_fim', $data_hora_fim);
            });

        $movimentacoes = $query->get();

        return view('gerenciar_movimentacao', compact('movimentacoes'));
    }

    public function relatorio_movimentacoes()
    {
        $movimentacoes = DB::select('
            SELECT c.cliente, COUNT(*) as total,
                SUM(CASE WHEN c.categoria = "Importação" THEN 1 ELSE 0 END) as total_importacao,
                SUM(CASE WHEN c.categoria = "Exportação" THEN 1 ELSE 0 END) as total_exportacao
            FROM container c
            JOIN movimentacao m ON c.id = m.container_id
            GROUP BY c.cliente
        ');

        return view('movimentacoes', ['movimentacoes' => $movimentacoes]);
    }
}
