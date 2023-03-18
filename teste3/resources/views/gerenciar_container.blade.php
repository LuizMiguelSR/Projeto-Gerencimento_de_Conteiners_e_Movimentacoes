@php
    $title = "Gerenciar Containers";
@endphp

@extends('layouts.layout')

@section('content')
<section>
    <main>
        <div>
            <h1>Gerenciar Containers</h1>
        </div>
        <div>
            <form method="POST" action="{{ route('filtrar_container') }}">
                @csrf
                <div>
                    <label for="cliente">Cliente:</label>
                    <input type="text" name="cliente" id="cliente">
                </div>
                <div>
                    <label for="tipo">Tipo:</label>
                    <select name="tipo" id="tipo">
                        <option value="">Selecione</option>
                        <option value="20">20 pés</option>
                        <option value="40">40 pés</option>
                    </select>
                </div>
                <div>
                    <label for="status">Status:</label>
                    <select name="status" id="status">
                        <option value="">Selecione</option>
                        <option value="Vazio">Vazio</option>
                        <option value="Cheio">Cheio</option>
                    </select>
                </div>
                <div>
                    <label for="categoria">Categoria:</label>
                    <select name="categoria" id="categoria">
                        <option value="">Selecione</option>
                        <option value="Importação">Importação</option>
                        <option value="Exportação">Exportação</option>
                    </select>
                </div>
                <button type="submit">Filtrar</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Número do contêiner</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Categoria</th>
                        <th rowspan="2">Opções</th>
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
                            <a href="{{ route('containers.edit', $container->id) }}">Editar</a>
                        </td>
                        <td>
                            <form action="{{ route('containers.destroy', $container->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <a href="/home">Voltar</a>
        </div>
    </main>
</section>
