@php
    $title = "Gerenciar Movimentações";
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
        <h2>Gerenciar Movimentações</h2>
        <div>

            <form class="row g-3" method="post" action="{{ route('movimentacoes_filtrar_movimentacao') }}">
                @csrf
                <div class="col-md-12 mt-5">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label" for="cliente">Cliente:</label>
                            <input class="form-control" pattern="([aA-zZzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+)" maxlength="50" type="text" name="cliente" id="cliente">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="numero_container">Número do Contêiner:</label>
                            <input class="form-control" pattern="[A-Z]{4}[0-9]{7}" maxlength="11" type="text" name="numero_container" id="numero_container">
                        </div>

                        <div class="col-md-2">
                        <label class="form-label" for="tipo">Tipo de Movimentação:</label>
                            <select class="form-control" id="tipo" name="tipo">
                                <option value="">Tipo de movimentação</option>
                                <option value="Embarque">Embarque</option>
                                <option value="Descarga">Descarga</option>
                                <option value="Gate in">Gate In</option>
                                <option value="Gate out">Gate Out</option>
                                <option value="Reposicionamento">Reposicionamento</option>
                                <option value="Pesagem">Pesagem</option>
                                <option value="Scanner">Scanner</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label" for="data_hora_inicio">Data e Hora de Início:</label>
                            <input class="form-control" type="datetime-local" name="data_hora_inicio">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label" for="data_hora_fim">Data e Hora de Fim:</label>
                            <input class="form-control" type="datetime-local" name="data_hora_fim">
                        </div>

                        <div class="col-md-2 mt-2">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </div>
            </form>

            <form class="row g-3" method="post" action="{{ route('movimentacoes_ordernar_movimentacao') }}">
                @csrf
                <div class="col-md-3 mt-2">

                    <label class="form-label" for="nome">Ordenar por cliente:</label>
                    <select class="form-control" name="nome" id="nome">
                        <option value="">Selecione</option>
                        <option value="ASC">A-Z</option>
                        <option value="DESC">Z-A</option>
                    </select>

                    <button type="submit" class="btn btn-primary mt-2">Ordenar</button>
                </div>
            </form>

            <h2>Movimentações</h2>
            <table class="table table table-hover">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Número do contêiner</th>
                        <th>Tipo de movimentação</th>
                        <th>Data Hora Inicio</th>
                        <th>Data Hora Fim</th>
                        <th colspan="2">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movimentacoes as $movimentacao)
                    <tr>
                        <td>{{ $movimentacao->container->cliente }}</td>
                        <td>{{ $movimentacao->container->numero_container }}</td>
                        <td>{{ $movimentacao->tipo }}</td>
                        <td>{{ \Carbon\Carbon::parse($movimentacao->data_hora_inicio)->format('d/m/Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($movimentacao->data_hora_fim)->format('d/m/Y H:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $movimentacao->id }}">
                                Editar Movimentação
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('movimentacoes.destroy', $movimentacao->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModal{{ $movimentacao->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="exampleModalLabel">Editar Movimentação</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <label>Cliente:{{ $movimentacao->container->cliente }}</label>
                                    </div>
                                    <div>
                                        <label>Número do Contêiner:{{ $movimentacao->container->numero_container }}</label>
                                    </div>
                                    <form method="post" action="{{ route('movimentacoes.update', $movimentacao->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <label for="tipo">Tipo de movimentação:</label>
                                        <select name="tipo">
                                            <option value="Embarque" {{ $movimentacao->tipo === "Embarque" ? "selected" : "" }}>Embarque</option>
                                            <option value="Descarga" {{ $movimentacao->tipo === "Descarga" ? "selected" : "" }}>Descarga</option>
                                            <option value="Gate in" {{ $movimentacao->tipo === "Gate in" ? "selected" : "" }}>Gate in</option>
                                            <option value="Gate out" {{ $movimentacao->tipo === "Gate out" ? "selected" : "" }}>Gate out</option>
                                            <option value="Reposicionamento" {{ $movimentacao->tipo === "Reposicionamento" ? "selected" : "" }}>Reposicionamento</option>
                                            <option value="Pesagem" {{ $movimentacao->tipo === "Pesagem" ? "selected" : "" }}>Pesagem</option>
                                            <option value="Scanner" {{ $movimentacao->tipo === "Scanner" ? "selected" : "" }}>Scanner</option>
                                        </select>

                                        <div>
                                            <label for="data_hora_inicio">Data e Hora de Início:</label>
                                            <input type="datetime-local" name="data_hora_inicio" value="{{ $movimentacao->data_hora_inicio }}">
                                        </div>

                                        <div>
                                            <label for="data_hora_fim">Data e Hora de Fim:</label>
                                            <input type="datetime-local" name="data_hora_fim" value="{{ $movimentacao->data_hora_fim }}">
                                        </div>

                                        <button type="submit" class="btn btn-success">Atualizar</button>
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
