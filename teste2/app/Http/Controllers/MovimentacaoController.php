<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Container;
use App\Models\Movimentacao;

class MovimentacaoController extends Controller
{
    public function index(Request $request, $id)
    {
        $container = Container::findOrFail($id);
        return view('formulario_movimentacao', compact('container'));
    }

    public function movimentar(Request $request)
    {
        $containers = Container::all();
        return view('movimentar', compact('containers'));
    }

    public function gerenciar(Request $request)
    {
        $movimentacoes = Movimentacao::all()->groupBy('container_id');
        return view('gerenciar_movimentacao', compact('movimentacoes'));
    }

    public function novo(Request $request)
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
            'data_hora_inicio' => $dataMovimentacao['data_hora_inicio'] . ':00', // Adiciona segundos à data/hora de início
            'data_hora_fim' => $dataMovimentacao['data_hora_fim'] . ':00' // Adiciona segundos à data/hora de fim
        ]);

        return redirect()->route('home');
    }
}
