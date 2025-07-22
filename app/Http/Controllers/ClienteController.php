<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Categoria;
use App\Rules\ValidaCpf;

class ClienteController extends Controller
{
    /*────────────────────────  LISTA  ────────────────────────*/
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $clientes = Cliente::with(['subcategoria.categoria'])
            ->when($busca, function ($q) use ($busca) {
                $q->where('clientes.nome', 'like', "%{$busca}%")
                ->orWhere('clientes.cpf', 'like', "%{$busca}%")
                ->orWhere('clientes.telefone', 'like', "%{$busca}%")
                ->orWhere('clientes.rua', 'like', "%{$busca}%")
                ->orWhere('clientes.bairro', 'like', "%{$busca}%")
                ->orWhere('clientes.cidade', 'like', "%{$busca}%")
                ->orWhereHas('categoria', function ($cat) use ($busca) {
                    $cat->where('categorias.nome', 'like', "%{$busca}%");
                })
                ->orWhereHas('subcategoria', function ($sub) use ($busca) {
                    $sub->where('subcategorias.nome', 'like', "%{$busca}%");
                });
            })
            ->orderBy('nome')
            ->paginate(10)
            ->appends(['busca' => $busca]);

        return view('clientes.index', compact('clientes', 'busca'));
    }

    /*────────────────────────  FORM CREATE  ───────────────────*/
    public function create()
    {
        $categorias = Categoria::with('subcategorias')->orderBy('nome')->get();
        return view('clientes.create', compact('categorias'));
    }

    /*────────────────────────  SALVAR  ────────────────────────*/
    public function store(Request $request)
    {
        $request->validate([
            'nome'            => 'required|string|max:255',
            'cpf'             => ['required','unique:clientes,cpf', new ValidaCpf],
            'telefone'        => 'required|string|max:20',
            'rua'             => 'required|string|max:255',
            'bairro'          => 'required|string|max:255',
            'numero'          => 'required|string|max:20',
            'complemento'     => 'nullable|string|max:255',
            'cidade'          => 'required|string|max:100',
            'estado'          => 'required|string|max:2',
            'cep'             => 'required|string|max:9',
            'categoria_id'    => 'required|exists:categorias,id',
            'subcategoria_id' => 'required|exists:subcategorias,id',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
               ->with('success','Cliente cadastrado com sucesso!');
    }

    /*────────────────────────  FORM EDIT  ─────────────────────*/
    public function edit(Cliente $cliente)
    {
        $categorias = Categoria::with('subcategorias')->orderBy('nome')->get();
        return view('clientes.edit', compact('cliente','categorias'));
    }

    /*────────────────────────  ATUALIZAR  ─────────────────────*/
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome'            => 'required|string|max:255',
            'cpf'             => ['required','unique:clientes,cpf,'.$cliente->id, new ValidaCpf],
            'telefone'        => 'required|string|max:20',
            'rua'             => 'required|string|max:255',
            'bairro'          => 'required|string|max:255',
            'numero'          => 'required|string|max:20',
            'complemento'     => 'nullable|string|max:255',
            'cidade'          => 'required|string|max:100',
            'estado'          => 'required|string|max:2',
            'cep'             => 'required|string|max:9',
            'categoria_id'    => 'required|exists:categorias,id',
            'subcategoria_id' => 'required|exists:subcategorias,id',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
               ->with('success','Cliente atualizado com sucesso!');
    }

    /*────────────────────────  EXCLUIR  ───────────────────────*/
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')
               ->with('success','Cliente deletado com sucesso!');
    }
}
