<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        header {
            background-color: #003366;
            color: white;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .logo-img {
            max-height: 50px;
        }

        .user-info {
            font-size: 0.9rem;
        }

        .logout-btn {
            color: white;
            border: 1px solid white;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background-color: white;
            color: #003366;
        }

        main {
            padding-top: 1.5rem;
        }

        @media (max-width: 576px) {
            header h4 {
                font-size: 1.1rem;
            }
        }

        table th:nth-child(3),
        table td:nth-child(3) {
            min-width: 160px; /* telefone */
        }

        table th:nth-child(2),
        table td:nth-child(2) {
            min-width: 160px; /* CPF */
        }

        table td, table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>

    @auth
    <header class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="d-flex align-items-center gap-3">
            {{-- Logo e título --}}
            <img src="{{ asset('images/logoCasaConstrutor.jpg') }}" alt="Logo da Loja" class="logo-img">
            <h4 class="mb-0 fw-bold text-white">Catálogo de Clientes</h4>
        </div>

        <div class="dropdown mt-2 mt-md-0">
            <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
                {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                {{-- Futuro: <li><a class="dropdown-item" href="#">Meu Perfil</a></li> --}}
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">Sair</button>
                    </form>
                </li>
            </ul>
        </div>
    </header>
    @endauth

    <main class="container-fluid px-3 mt-4">
        @yield('content')
    </main>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function(){
            $('input[name="cpf"]').mask('000.000.000-00');
            $('input[name="telefone"]').mask('(00) 00000-0000');
            $('input[name="cep"]').mask('00000-000');
        });

        $(document).ready(function() {
            $('#cep').on('blur', function() {
                var cep = $(this).val().replace(/\D/g, '');

                if (cep.length !== 8) {
                    alert('CEP inválido. Digite 8 números.');
                    return;
                }

                // Limpa os campos antes de buscar
                $('#rua').val('');
                $('#bairro').val('');
                $('#cidade').val('');
                $('#estado').val('');

                $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
                    if (!data.erro) {
                        $('#rua').val(data.logradouro);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.localidade);
                        $('#estado').val(data.uf);
                    } else {
                        alert('CEP não encontrado. Verifique o número digitado.');
                    }
                }).fail(function() {
                    alert('Erro ao consultar o CEP. Verifique sua conexão.');
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
