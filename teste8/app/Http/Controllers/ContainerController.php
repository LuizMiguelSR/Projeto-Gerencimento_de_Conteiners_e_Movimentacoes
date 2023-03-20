<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Container;

class ContainerController extends Controller
{
    public function create()
    {
        return view('novo_container');
    }

    public function store(Request $request)
    {
        $dataContainer = $request->validate([
            'cliente' => 'required|max:50',
            'numero_container' => 'required|max:11',
            'tipo' => 'required|in:20,40',
            'status' => 'required|in:Cheio,Vazio',
            'categoria' => 'required|in:Importação,Exportação',
        ]);
        $container = Container::create($dataContainer);
        return redirect()->route('containers.index');
    }

    public function index()
    {
        $containers = Container::all();
        return view('gerenciar_container', compact('containers'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'cliente' => 'required|max:50',
            'numero_container' => 'required|max:11',
            'tipo' => 'required|in:20,40',
            'status' => 'required|in:Cheio,Vazio',
            'categoria' => 'required|in:Importação,Exportação',
        ]);
        $container = Container::findOrFail($id);
        $container->update($data);
        return redirect()->route('containers.index');
    }

    public function destroy($id)
    {
        Container::destroy($id);
        return redirect()->route('containers.index');
    }

    public function filtrar(Request $request)
    {
        $query = Container::query()
        ->when($request->cliente, function($query, $cliente){
            return $query->where('cliente', 'LIKE', '%' . $cliente . '%');
        })
        ->when($request->numero_container, function($query, $numero_container){
            return $query->where('numero_container', 'LIKE', '%' . $numero_container . '%');
        })
        ->when($request->tipo, function($query, $tipo){
            return $query->where('tipo', $tipo);
        })
        ->when($request->status, function($query, $status){
            return $query->where('status', $status);
        })
        ->when($request->categoria, function($query, $categoria){
            return $query->where('categoria', $categoria);
        });
        $containers = $query->get();
        return view('gerenciar_container', compact('containers'));
    }
}
