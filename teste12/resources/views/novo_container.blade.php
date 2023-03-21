@php
    $title = "Novo Contêiner";
@endphp

@extends('layouts.layout')

@section('content')
<section>
    <main>
        <div class="container">
            <div class="imagem">
                <img src="{{ asset('imagens/cargo-ship.png') }}" alt="Registrar Container" title="Registrar Container">
                <h1>Empresa X</h1>
            </div>
        </div>
        <h2>Novo Contêiner</h2>
        <div>
            <form class="row g-3" method="post" action="{{ route('containers.store') }}">
            @csrf
                <div class="col-md-12 mt-5">
                    <label for="cliente">Cliente:</label>
                    <input name="cliente" type="text" class="form-control" id="cliente" placeholder="Cliente" required pattern="([aA-zZzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+)" maxlength="50">

                    <label for="numero_container">Número do container:</label>
                    <input type="text" id="numero_container" name="numero_container" pattern="[A-Z]{4}[0-9]{7}" placeholder="Ex: TEST1234567" required maxlength="11">

                    <label for="tipo">Tipo do contêiner:</label>
                    <select id="tipo"  type="number" name="tipo" required>
                        <option value="">Selecione o tipo de contêiner</option>
                        <option value="20">20 pés</option>
                        <option value="40">40 pés</option>
                    </select>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="">Selecione o status do contêiner</option>
                        <option value="Cheio">Cheio</option>
                        <option value="Vazio">Vazio</option>
                    </select>

                    <label for="categoria">Categoria:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">Selecione a categoria do contêiner</option>
                        <option value="Importação">Importação</option>
                        <option value="Exportação">Exportação</option>
                    </select>

                    <button type="submit" class="btn btn-primary">ADICIONAR</button>
                </div>
            </form>
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
