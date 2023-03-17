@php
    $title = "Gerenciar Movimentações";
@endphp

@extends('layouts.layout')

@section('content')
<section>
    <main>
        <div>
            <h1>Gerenciar Movimentações</h1>
        </div>
        <div>
            @foreach ($movimentacoes as $cliente => $movimentacoesCliente)
                <h2>Cliente: {{ $cliente }}</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Container</th>
                            <th>Tipo</th>
                            <th>Data/Hora Início</th>
                            <th>Data/Hora Fim</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimentacoesCliente as $movimentacao)
                            <tr>
                                <td>{{ $movimentacao->container_id }}</td>
                                <td>{{ $movimentacao->tipo }}</td>
                                <td>{{ $movimentacao->data_hora_inicio }}</td>
                                <td>{{ $movimentacao->data_hora_fim }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
        <div>
            <a href="/home">Voltar</a>
        </div>
    </main>
</section>
