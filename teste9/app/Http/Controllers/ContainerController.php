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
        return redirect()->route('containers.create');
    }

    public function index()
    {
        $containers = Container::all();
        return view('gerenciar_container', compact('containers'));
    }

    public function update(Request $request, $id)
    {
        $dataContainer = $request->validate([
            'cliente' => 'required|max:50',
            'numero_container' => 'required|max:11',
            'tipo' => 'required|in:20,40',
            'status' => 'required|in:Cheio,Vazio',
            'categoria' => 'required|in:Importação,Exportação',
        ]);
        $containers = Container::findOrFail($id);
        $containers->update($dataContainer);
        return redirect()->route('containers.index');
    }

    public function destroy($id)
    {
        Container::destroy($id);
        return redirect()->route('containers.index');
    }

    public function ordenar(Request $request)
    {
        if ($request->nome === 'ASC') {
            $containers = Container::orderBy('cliente', 'ASC')->get();
            return view('gerenciar_container', compact('containers'));
        }
        if ($request->nome === 'DESC') {
            $containers = Container::orderBy('cliente', 'DESC')->get();
            return view('gerenciar_container', compact('containers'));
        }
        if (empty($request->nome)) {
            return redirect()->route('containers.index');
        }
    }

    public function filtrar(Request $request)
    {
        $containers = Container::query()
            ->when($request->cliente, fn($query) => $query->where('cliente', 'LIKE', '%' . $request->cliente . '%'))
            ->when($request->numero_container, fn($query) => $query->where('numero_container', 'LIKE', '%' . $request->numero_container . '%'))
            ->when($request->tipo, fn($query) => $query->where('tipo', $request->tipo))
            ->when($request->status, fn($query) => $query->where('status', $request->status))
            ->when($request->categoria, fn($query) => $query->where('categoria', $request->categoria))
            ->get();
        return view('gerenciar_container', compact('containers'));
    }

}
