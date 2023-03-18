@php
    $title = "Página Inicial";
@endphp

@extends('layouts.layout')

@section('content')
<section>
    <main>
        <h1>Home</h1>
        <h3>Container</h3>
        <div>
            <a href="/novo_container">Novo Container</a>
            <a href="/gerenciar_container">Gerenciar Containers</a>
        </div>
        <h3>Movimentações</h3>
        <div>
            <a href="/movimentar">Novas Movimentações</a>
            <a href="/gerenciar_movimentacao">Gerenciar Movimentações</a>
        </div>
    </main>
</section>
