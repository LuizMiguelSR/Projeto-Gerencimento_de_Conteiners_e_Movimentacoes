@php
    $title = "Relatório de Movimentação";
@endphp

@extends('layouts.layout')

@section('content')
<section>
    <main>
        <div class="container">
            <div class="imagem">
                <img src="{{ asset('imagens/cargo-ship.png') }}" alt="Empresa X" title="Empresa X">
                <h1>Empresa X</h1>
            </div>
        </div>
        <h2>Relatório de Movimentações</h2>

        <table class="table table table-hover">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Total de Movimentações</th>
                    <th>Total Importação</th>
                    <th>Total Exportação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movimentacoes as $movimentacao)
                    <tr>
                        <td>{{ $movimentacao->cliente }}</td>
                        <td>{{ $movimentacao->total }}</td>
                        <td>{{ $movimentacao->total_importacao }}</td>
                        <td>{{ $movimentacao->total_exportacao }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="container">
            <div class="imagem">
                <a href="/home">
                    <img class="back" src="{{ asset('imagens/back-button.png') }}" alt="Voltar" title="Voltar">
                    <h6 class="menu">Voltar</h6>
                </a>
            </div>
        </div>
    </main>
</section>
