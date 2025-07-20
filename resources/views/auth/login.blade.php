@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-5" style="width: 100%; max-width: 500px; border-radius: 12px;">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logoCasaConstrutor.jpg') }}" alt="Logo da Loja" style="max-height: 80px;">
        </div>
        <h3 class="text-center mb-4 fw-semibold">Acesso Restrito</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label">E-mail</label>
                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Senha</label>
                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                    name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Lembrar-me
                </label>
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    Entrar
                </button>
            </div>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                        Esqueceu sua senha?
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
