@php
    $title = "Nova Movimentação";
@endphp

@extends('layouts.layout')

@section('content')
<section>
    <main>
        <div>
            <h1>Nova Movimentação</h1>
            <h2>Cliente: {{ $container->cliente }}</h2>
            <h2>Container: {{ $container->numero_container }}</h2>
        </div>
        <div>
            <form method="post" action="/nova_movimentacao">
            @csrf
                <div>
                <label for="tipo">Tipo de Movimentação:</label>
                <select id="tipo"  type="number" name="tipo" required>
                    <option value="">Selecione o tipo de movimentação</option>
                    <option value="Embarque">Embarque</option>
                    <option value="Descarga">Descarga</option>
                    <option value="Gate in">Gate In</option>
                    <option value="Gate out">Gate Out</option>
                    <option value="Reposicionamento">Reposicionamento</option>
                    <option value="Pesagem">Pesagem</option>
                    <option value="Scanner">Scanner</option>
                </select>
                </div>

                <input type="hidden" name="container_id" value="{{ $container->id }}">
                <div>
                    <label for="data_hora_inicio">Data e Hora de Início:</label>
                    <input type="datetime-local" name="data_hora_inicio" required>
                </div>

                <div>
                    <label for="data_hora_fim">Data e Hora de Fim:</label>
                    <input type="datetime-local" name="data_hora_fim" required>
                </div>

                <div>
                    <button type="submit">CADASTRAR</button>
                </div>
            </form>
        </div>
        <div>
            <a href="/home">Voltar</a>
        </div>
    </main>
</section>
