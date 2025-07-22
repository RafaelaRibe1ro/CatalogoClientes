@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Categorias</h2>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar para Clientes
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulário de nova categoria --}}
    <form action="{{ route('categorias.store') }}" method="POST" class="d-flex mb-4 gap-2">
        @csrf
        <input type="text" name="nome" class="form-control" placeholder="Nova categoria" required>
        <button class="btn btn-primary">Cadastrar</button>
    </form>

    {{-- Lista de categorias --}}
    <table class="table table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Categoria</th>
                <th style="width: 250px;">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <form action="{{ route('categorias.update', $categoria) }}" method="POST" class="w-100 d-flex">
                    @csrf
                    @method('PUT')
                    <td>
                        <input type="text" name="nome" value="{{ $categoria->nome }}" class="form-control" required>
                    </td>
                    <td class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-outline-warning w-100 h-100">
                            <i class="bi bi-save"></i> Salvar
                        </button>
                </form>
                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="w-100 h-100" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100 h-100">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </form>
                    </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
