@extends('layout')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Subcategorias</h2>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar para Contatos
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Novo cadastro --}}
    <form action="{{ route('subcategorias.store') }}" method="POST" class="row g-2 align-items-end mb-4">
        @csrf
        <div class="col-md-5">
            <label class="form-label">Nome da Subcategoria</label>
            <input name="nome" class="form-control" required>
        </div>
        <div class="col-md-5">
            <label class="form-label">Categoria</label>
            <select name="categoria_id" class="form-select" required>
                <option value="">Selecione…</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

    {{-- Lista --}}
    <table class="table table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Subcategoria</th>
                <th>Categoria</th>
                <th style="width: 250px;">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($subcategorias as $sub)
            <tr>
                <form action="{{ route('subcategorias.update', $sub) }}" method="POST" class="w-100 d-flex">
                    @csrf
                    @method('PUT')
                    <td>
                        <input name="nome" value="{{ $sub->nome }}" class="form-control" required>
                    </td>
                    <td>
                        <select name="categoria_id" class="form-select" required>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" {{ $sub->categoria_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nome }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-warning w-100 h-100">
                            <i class="bi bi-save"></i> Salvar
                        </button>
                </form>

                        <form action="{{ route('subcategorias.destroy', $sub) }}" method="POST" class="w-100 h-100" onsubmit="return confirm('Excluir?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger w-100 h-100">
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
