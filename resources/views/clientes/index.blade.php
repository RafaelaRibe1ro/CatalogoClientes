@extends('layout')

@section('content')
<style>
    /* Padding confortável nas células */
    .custom-table-hover td,
    .custom-table-hover th {
        padding: 1.1rem 1rem;
    }

    /* Hover suave */
    .custom-table-hover tbody tr:hover {
        background-color: #f1f1f1 !important;
    }

    /* Largura mínima para colunas */
    .custom-table-hover td:nth-child(2),
    .custom-table-hover th:nth-child(2),
    .custom-table-hover td:nth-child(3),
    .custom-table-hover th:nth-child(3) {
        min-width: 180px;
    }

    /* Largura do container mais moderada */
    .container {
        max-width: 1400px;
        margin: 0 auto;
    }
</style>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Contatos - Casa do Construtor</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
        <form action="{{ route('clientes.index') }}" method="GET" class="d-flex flex-grow-1 gap-2">
            <input type="text" name="busca" class="form-control" placeholder="Buscar por nome, CPF, telefone..." value="{{ $busca ?? '' }}">
            <button type="submit" class="btn btn-outline-primary d-flex align-items-center gap-1">
                <i class="bi bi-search"></i> Buscar
            </button>
            @if(!empty($busca))
                <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                    <i class="bi bi-x-circle"></i> Limpar
                </a>
            @endif
        </form>

        <a href="{{ route('clientes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Cadastrar Novo Cliente
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm custom-table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Data de Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->cpf }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>
                        <strong>{{ $cliente->rua }}, {{ $cliente->numero }}</strong><br>
                        {{ $cliente->bairro }}<br>
                        {{ $cliente->cidade }}/{{ $cliente->estado }}<br>
                        @if($cliente->complemento)
                            <small>Complemento: {{ $cliente->complemento }}</small><br>
                        @endif
                        <small class="text-muted">CEP: {{ $cliente->cep }}</small>
                    </td>
                    <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex flex-column flex-md-row gap-2">
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning d-flex align-items-center gap-1">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" onsubmit="return confirm('Deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger d-flex align-items-center gap-1">
                                    <i class="bi bi-trash"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Nenhum cliente cadastrado.</td></tr>
            @endforelse
            </tbody>
        </table>

        {{-- PAGINADOR --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $clientes->links() }}
        </div>
    </div>
</div>
@endsection
