@php
    $title = "Página Inicial";
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
        <h2>Página Inicial</h2>
        <div class="container">
            <div class="container">
                <div class="imagem">
                    <a href="/novo_container">
                        <img src="{{ asset('imagens/novoContainer.png') }}" alt="Registrar Container" title="Registrar Container">
                        <h6 class="menu">Registrar Container</h6>
                    </a>
                </div>
                <div class="imagem">
                    <a href="/gerenciar_container">
                        <img src="{{ asset('imagens/container.png') }}" alt="Gerenciar Containers" title="Gerenciar Containers">
                        <h6 class="menu">Gerenciar Containers</h6>
                    </a>
                </div>
            </div>
            <div class="container">
                <div class="imagem">
                    <a href="/nova_movimentacao">
                        <img src="{{ asset('imagens/cargo.png') }}" alt="Novas Movimentações" title="Novas Movimentações">
                        <h6 class="menu">Novas Movimentaçõesr</h6>
                    </a>
                </div>
                <div class="imagem">
                    <a href="/gerenciar_movimentacao">
                        <img src="{{ asset('imagens/transportation.png') }}" alt="Gerenciar Movimentações" title="Gerenciar Movimentações">
                        <h6 class="menu">Gerenciar Movimentações</h6>
                    </a>
                </div>
                <div class="imagem">
                    <a href="/relatorio-movimentacoes">
                        <img src="{{ asset('imagens/report.png') }}" alt="Relatório Movimentações" title="Relatório Movimentações">
                        <h6 class="menu">Relatório de Movimentaçõesr</h6>
                    </a>
                </div>
            </div>
        </div>
    </main>
</section>
