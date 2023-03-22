@php
    $title = "Nova Movimentação";
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
        <h2>Nova Movimentação</h2>
        <div>
            <form class="row g-3" method="post" action="{{ route('movimentacoes_filtrar_container') }}">
                @csrf
                <div class="col-md-3 mt-5">
                    <label class="form-label" for="cliente">Filtrar por cliente:</label>
                    <input class="form-control" type="text" name="cliente" id="cliente" pattern="([aA-zZzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+)" maxlength="50">

                    <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
                </div>

                <div class="col-md-3 mt-5">
                    <label class="form-label" for="numero_container">Filtrar pelo número do container:</label>
                    <input class="form-control" type="text" name="numero_container" id="numero_container" pattern="[A-Z]{4}[0-9]{7}" maxlength="11">

                </div>
            </form>
            <form class="row g-3" method="post" action="{{ route('movimentacoes_ordernar_container') }}">
                @csrf
                <div class="col-md-3 mt-2">

                    <label class="form-label" for="nome">Ordenar por cliente:</label>
                    <select class="form-control" name="nome" id="nome">
                        <option value="">Selecione</option>
                        <option value="ASC">A-Z</option>
                        <option value="DESC">Z-A</option>
                    </select>

                    <button type="submit" class="btn btn-primary mt-3">Ordenar</button>
                </div>
            </form>
            <h2>Contêiners Disponíveis</h2>
            <table class="table table table-hover">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Número do contêiner</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($containers as $container)
                    <tr>
                        <td>{{ $container->cliente }}</td>
                        <td>{{ $container->numero_container }}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $container->id }}">
                                Movimentar
                            </button>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModal{{ $container->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="exampleModalLabel">Nova Movimentação</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <label>Cliente: {{ $container->cliente }}</label>
                                    </div>
                                    <div>
                                        <label>Número do Container: {{ $container->numero_container }}</label>
                                    </div>
                                    <form method="post" action="{{ route('movimentacoes.store') }}">
                                        @csrf
                                        @method('POST')
                                        <div>
                                            <label for="tipo">Tipo de Movimentação:</label>
                                            <select id="tipo" name="tipo" required>
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
                                                <label for="data_hora_inicio">Data e Hora de Início: </label>
                                                <input type="datetime-local" name="data_hora_inicio" required>
                                            </div>

                                            <div>
                                                <label for="data_hora_fim">Data e Hora de Fim: </label>
                                                <input type="datetime-local" name="data_hora_fim" required>
                                            </div>

                                            <div>
                                                <button class="btn btn-success" type="submit">Movimentar</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
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
