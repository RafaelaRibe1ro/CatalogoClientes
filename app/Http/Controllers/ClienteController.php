<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Rules\ValidaCpf;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $clientes = Cliente::query()
            ->when($busca, function ($query, $busca) {
                $query->where('nome', 'like', "%{$busca}%")
                    ->orWhere('cpf', 'like', "%{$busca}%")
                    ->orWhere('telefone', 'like', "%{$busca}%")
                    ->orWhere('rua', 'like', "%{$busca}%")
                    ->orWhere('bairro', 'like', "%{$busca}%")
                    ->orWhere('cidade', 'like', "%{$busca}%");
            })
            ->orderBy('nome')
            ->paginate(10)
            ->appends(['busca' => $busca]);

        return view('clientes.index', compact('clientes', 'busca'));
    }

    public function create() {
        return view('clientes.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['required', 'unique:clientes,cpf,' . ($cliente->id ?? ''), new ValidaCpf],
            'telefone' => 'required|string|max:20',
            'rua' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:9',
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit(Cliente $cliente) {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente) {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['required', 'unique:clientes,cpf,' . ($cliente->id ?? ''), new ValidaCpf],
            'telefone' => 'required|string|max:20',
            'rua' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:9',
        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso.');
    }

    public function destroy(Cliente $cliente) {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente deletado com sucesso.');
    }
}

