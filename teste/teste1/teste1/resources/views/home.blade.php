@php
    $title = "cadastro de container";
@endphp

@extends('layouts.layout')

@section('content')
<section>
    <main>
        <h1>Home</h1>
        <h3>Container</h3>
        <div>
            <a href="/formulario_container">Gerenciar Containers</a>
            <a href="/formulario_container">Cadastrar Container</a>
            <a href="/formulario_container">Alterar Container</a>
            <a href="/formulario_container">Remover Container</a>
        </div>
        <h3>Movimentações</h3>
        <div>
            <a href="/movimentacao">Gerenciar Movimentações</a>
            <a href="/movimentacao">Nova Movimentação</a>
        </div>
        <div>
            <a href="/logout">Sair</a>
        </div>
    </main>
</section>
