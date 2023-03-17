@php
    $title = "Editar Container";
@endphp

@extends('layouts.layout')

@section('content')
<section>
    <main>
        <div>
            <h1>Editar Container</h1>
        </div>
        <div>
            <form method="POST" action="{{ route('containers.update', $container->id) }}">
                @csrf
                @method('PUT')

                <label for="cliente">Cliente:</label>
                <input type="text" name="cliente" value="{{ $container->cliente }}" required>

                <label for="numero_container">Número do Contêiner:</label>
                <input type="text" name="numero_container" value="{{ $container->numero_container }}" required>

                <label for="tipo">Tipo:</label>
                <select name="tipo" required>
                    <option value="20" {{ $container->tipo === "20" ? "selected" : "" }}>20 pés</option>
                    <option value="40" {{ $container->tipo === "40" ? "selected" : "" }}>40 pés</option>
                </select>

                <label for="status">Status:</label>
                <select name="status" required>
                    <option value="Cheio" {{ $container->status === "Cheio" ? "selected" : "" }}>Cheio</option>
                    <option value="Vazio" {{ $container->status === "Vazio" ? "selected" : "" }}>Vazio</option>
                </select>

                <label for="categoria">Categoria:</label>
                <select name="categoria" required>
                    <option value="Importação" {{ $container->categoria === "Importação" ? "selected" : "" }}>Importação</option>
                    <option value="Exportação" {{ $container->categoria === "Exportação" ? "selected" : "" }}>Exportação</option>
                </select>
                
                <button type="submit">Salvar</button>
            </form>
        </div>
        <div>
            <a href="/gerenciar_container">Voltar</a>
        </div>
    </main>
</section>
