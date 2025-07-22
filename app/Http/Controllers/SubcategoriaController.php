<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    public function index()
    {
        $subcategorias = Subcategoria::with('categoria')
                         ->orderBy('categoria_id')
                         ->orderBy('nome')
                         ->get();

        $categorias = Categoria::orderBy('nome')->get();

        return view('subcategorias.index',
            compact('subcategorias', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'         => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Subcategoria::create($request->only('nome','categoria_id'));

        return back()->with('success','Subcategoria cadastrada!');
    }

    public function update(Request $request, Subcategoria $subcategoria)
    {
        $request->validate([
            'nome'         => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $subcategoria->update($request->only('nome','categoria_id'));

        return back()->with('success','Subcategoria atualizada!');
    }

    public function destroy(Subcategoria $subcategoria)
    {
        $subcategoria->delete();
        return back()->with('success','Subcategoria excluída!');
    }
}
