@php
    $title = "Gerenciar Containers";
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
        <h2>Gerenciar Containers</h2>
        <div>
            <form class="row g-3" method="post" action="{{ route('filtrar_container') }}">
                @csrf
                <div class="col-md-12 mt-5">
                    <label for="cliente">Cliente:</label>
                    <input type="text" name="cliente" id="cliente" pattern="([aA-zZzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+)" maxlength="50">

                    <label for="numero_container">Número do Container:</label>
                    <input type="text" name="numero_container" id="numero_container" pattern="[A-Z]{4}[0-9]{7}" maxlength="11">

                    <label for="tipo">Tipo:</label>
                    <select name="tipo" id="tipo">
                        <option value="">Selecione</option>
                        <option value="20">20 pés</option>
                        <option value="40">40 pés</option>
                    </select>

                    <label for="status">Status:</label>
                    <select name="status" id="status">
                        <option value="">Selecione</option>
                        <option value="Vazio">Vazio</option>
                        <option value="Cheio">Cheio</option>
                    </select>

                    <label for="categoria">Categoria:</label>
                    <select name="categoria" id="categoria">
                        <option value="">Selecione</option>
                        <option value="Importação">Importação</option>
                        <option value="Exportação">Exportação</option>
                    </select>

                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>

            <table class="table table table-hover">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Número do conteiner</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Categoria</th>
                        <th colspan="2">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($containers as $container)
                    <tr>
                        <td>{{ $container->cliente }}</td>
                        <td>{{ $container->numero_container }}</td>
                        <td>{{ $container->tipo }}</td>
                        <td>{{ $container->status }}</td>
                        <td>{{ $container->categoria }}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $container->id }}">
                                Editar Container
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('containers.destroy', $container->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModal{{ $container->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5" id="exampleModalLabel">Editar Container</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <label>Cliente:{{ $container->cliente }}</label>
                                    </div>
                                    <div>
                                        <label>Número do Container:{{ $container->numero_container }}</label>
                                    </div>
                                    <form method="post" action="{{ route('containers.update', $container->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label for="cliente">Cliente:</label>
                                            <input type="text" name="cliente" pattern="([aA-zZzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+)" maxlength="50" value="{{ $container->cliente }}" required>
                                        </div>

                                        <div>
                                            <label for="numero_container">Número do Contêiner:</label>
                                            <input type="text" name="numero_container" pattern="[A-Z]{4}[0-9]{7}" maxlength="11" value="{{ $container->numero_container }}" required>
                                        </div>

                                        <div>
                                            <label for="tipo">Tipo:</label>
                                            <select name="tipo" required>
                                                <option value="20" {{ $container->tipo === "20" ? "selected" : "" }}>20 pés</option>
                                                <option value="40" {{ $container->tipo === "40" ? "selected" : "" }}>40 pés</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="status">Status:</label>
                                            <select name="status" required>
                                                <option value="Cheio" {{ $container->status === "Cheio" ? "selected" : "" }}>Cheio</option>
                                                <option value="Vazio" {{ $container->status === "Vazio" ? "selected" : "" }}>Vazio</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="categoria">Categoria:</label>
                                            <select name="categoria" required>
                                                <option value="Importação" {{ $container->categoria === "Importação" ? "selected" : "" }}>Importação</option>
                                                <option value="Exportação" {{ $container->categoria === "Exportação" ? "selected" : "" }}>Exportação</option>
                                            </select>
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
