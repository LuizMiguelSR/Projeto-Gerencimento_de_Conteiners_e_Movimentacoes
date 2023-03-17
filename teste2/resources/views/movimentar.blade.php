@php
    $title = "Nova Movimentação";
@endphp

@extends('layouts.layout')

@section('content')
<section>
    <main>
        <div>
            <h1>Nova Movimentação</h1>
        </div>
        <div>
            <table>
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
                            <a href="/formulario_movimentacao/{{ $container->id }}">Movimentar</a>
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
