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

    public function novo(Request $request)
    {
        $dataContainer = $request->validate([
            'cliente' => 'required|max:50',
            'numero_container' => 'required|max:11',
            'tipo' => 'required|in:20,40',
            'status' => 'required|in:Cheio,Vazio',
            'categoria' => 'required|in:Importação,Exportação'
        ]);
        $container = Container::create($dataContainer);
        return redirect()->route('home');
    }

    public function gerenciar(Request $request)
    {
        $containers = Container::all();
        return view('gerenciar_container', compact('containers'));
    }

    public function edit(Container $container)
    {
        return view('editar_container', compact('container'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'cliente' => 'required|max:50',
            'numero_container' => 'required|max:11',
            'tipo' => 'required|in:20,40',
            'status' => 'required|in:Cheio,Vazio',
            'categoria' => 'required|in:Importação,Exportação'
        ]);
        $container = Container::findOrFail($id);
        $container->update($data);
        return redirect()->route('home');
    }
}
