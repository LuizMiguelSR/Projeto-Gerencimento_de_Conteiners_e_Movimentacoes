@php
    $title = "Formulário Container";
@endphp

@extends('layouts.layout')

@section('content')
<section>
    <main>
        <div>
            <h1>Cadastrar Container</h1>
        </div>
        <div>
            <form method="post" action="/cadastro_container">
            @csrf
                <div>
                    <label for="cliente">Cliente:</label>
                    <input name="cliente" type="text" class="form-control" id="cliente" placeholder="Cliente" required pattern="([aA-zZzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+)" maxlength="50">
                </div>

                <div>
                    <label for="numero_container">Número do contêiner:</label>
                    <input type="text" id="numero_container" name="numero_container" pattern="[A-Z]{4}[0-9]{7}" placeholder="Ex: TEST1234567" required maxlength="11">
                </div>

                <div>
                <label for="tipo">Tipo de contêiner:</label>
                <select id="tipo"  type="number" name="tipo" required>
                    <option value="">Selecione o tipo de contêiner</option>
                    <option value="20">20 pés</option>
                    <option value="40">40 pés</option>
                </select>
                </div>

                <div>
                <label for="status">Status do contêiner:</label>
                <select id="status" name="status" required>
                    <option value="">Selecione o status do contêiner</option>
                    <option value="cheio">Cheio</option>
                    <option value="vazio">Vazio</option>
                </select>
                </div>

                <label for="categoria">Categoria do contêiner:</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Selecione a categoria do contêiner</option>
                    <option value="importacao">Importação</option>
                    <option value="exportacao">Exportação</option>
                </select>

                <div>
                    <button type="submit">CADASTRAR</button>
                </div>
            </form>
        </div>
        <div>
            <a href="/home">Voltar</a>
        </div>
        <div>
            <a href="/logout">Sair</a>
        </div>
    </main>
</section>
