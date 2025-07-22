<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome',
        ]);

        Categoria::create([
            'nome' => $request->nome
        ]);

        return redirect()->back()->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome,' . $categoria->id,
        ]);

        $categoria->update(['nome' => $request->nome]);

        return redirect()->back()->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->back()->with('success', 'Categoria excluída com sucesso!');
    }
}
