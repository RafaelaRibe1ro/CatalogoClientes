@extends('layout')

@section('content')
<style>
    body {
        font-size: clamp(1rem, 2vw, 1.1rem);
    }

    button,
    .btn,
    input,
    select,
    textarea {
        font-size: clamp(1rem, 2vw, 1.1rem) !important;
    }

    .modal-body,
    .modal-title {
        font-size: 1.1rem;
    }

    .custom-table-hover td,
    .custom-table-hover th {
        padding: 1.1rem 1rem;
        font-size: 1.1rem;
    }

    .custom-table-hover tbody tr:hover {
        background-color: #f1f1f1 !important;
    }

    .custom-table-hover td:nth-child(2),
    .custom-table-hover th:nth-child(2),
    .custom-table-hover td:nth-child(3),
    .custom-table-hover th:nth-child(3) {
        min-width: 180px;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* RESPONSIVIDADE */
    @media (max-width: 768px) {
        .table-responsive table thead {
            display: none;
        }

        .table-responsive table tbody td {
            display: block;
            width: 100%;
            text-align: right;
            position: relative;
            padding-left: 50%;
            border: none;
            border-bottom: 1px solid #ddd;
        }

        .table-responsive table tbody td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 1rem;
            font-weight: bold;
            text-align: left;
        }

        .table-responsive table {
            border: none;
        }

        form.d-flex {
            flex-direction: column;
        }

        form.d-flex input,
        form.d-flex button,
        form.d-flex a {
            width: 100%;
        }

        .modal-dialog {
            max-width: 100%;
            margin: 0;
        }

        .modal-content {
            border-radius: 0;
            height: 100vh;
        }

        .modal-body {
            overflow-y: auto;
        }
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
            <i class="bi bi-plus-circle"></i> Cadastrar Novo Contato
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm custom-table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Categoria</th>
                    <th>Subcategoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                <tr>
                    <td data-label="Nome">{{ $cliente->nome }}</td>
                    <td data-label="CPF">{{ $cliente->cpf }}</td>
                    <td data-label="Telefone">{{ $cliente->telefone }}</td>
                    <td data-label="Categoria">{{ $cliente->subcategoria->categoria->nome ?? '-' }}</td>
                    <td data-label="Subcategoria">{{ $cliente->subcategoria->nome ?? '-' }}</td>
                    <td data-label="Ações">
                        <div class="d-flex flex-column flex-md-row gap-2">
                            <div class="d-grid w-100">
                                <button class="btn btn-sm btn-info w-100 d-flex flex-column align-items-center justify-content-center"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalCliente{{ $cliente->id }}">
                                    <i class="bi bi-eye mb-1"></i>
                                    Ver Mais
                                </button>
                            </div>

                            <div class="d-grid w-100">
                                <a href="{{ route('clientes.edit', $cliente) }}"
                                class="btn btn-sm btn-warning w-100 d-flex flex-column align-items-center justify-content-center">
                                    <i class="bi bi-pencil-square mb-1"></i>
                                    Editar
                                </a>
                            </div>

                            <div class="d-grid w-100">
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" onsubmit="return confirm('Deseja excluir?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-sm btn-danger w-100 d-flex flex-column align-items-center justify-content-center"
                                        style="height: 100%;">
                                        <i class="bi bi-trash mb-1"></i>
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="modalCliente{{ $cliente->id }}" tabindex="-1" aria-labelledby="modalClienteLabel{{ $cliente->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalClienteLabel{{ $cliente->id }}">
                                    Detalhes do Contato
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
                                <p><strong>CPF:</strong> {{ $cliente->cpf }}</p>
                                <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
                                <p><strong>Categoria:</strong> {{ $cliente->subcategoria->categoria->nome ?? '-' }}</p>
                                <p><strong>Subcategoria:</strong> {{ $cliente->subcategoria->nome ?? '-' }}</p>
                                <hr>
                                <p><strong>Endereço:</strong></p>
                                <p>{{ $cliente->rua }}, {{ $cliente->numero }}</p>
                                <p>{{ $cliente->bairro }} - {{ $cliente->cidade }}/{{ $cliente->estado }}</p>
                                @if($cliente->complemento)
                                    <p>Complemento: {{ $cliente->complemento }}</p>
                                @endif
                                <p>CEP: {{ $cliente->cep }}</p>
                                <p><small><strong>Cadastrado em:</strong> {{ $cliente->created_at->format('d/m/Y') }}</small></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>

        {{-- PAGINADOR --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $clientes->links() }}
        </div>
    </div>
</div>
@endsection
