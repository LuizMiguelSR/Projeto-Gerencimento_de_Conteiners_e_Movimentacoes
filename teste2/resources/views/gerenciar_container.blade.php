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
            <table>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Número do contêiner</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Categoria</th>
                        <th>Opções</th>
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
