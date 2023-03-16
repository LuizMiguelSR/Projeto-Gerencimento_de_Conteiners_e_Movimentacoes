<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Container;

class ContainerController extends Controller
{
    public function index()
    {
        return view('formulario_container');
    }

    public function cadastro(Request $request)
    {
        $dataContainer = $request->validate([
            'cliente' => 'required|max:50',
            'numero_container' => 'required|max:11',
            'tipo' => 'required|in:20,40',
            'status' => 'required|in:cheio,vazio',
            'categoria' => 'required|in:importacao,exportacao'
        ]);
        $container = Container::create($dataContainer);

        return redirect()->route('home');
    }
}
