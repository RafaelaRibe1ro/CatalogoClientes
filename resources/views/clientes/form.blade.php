<div class="row g-3">
    <div class="col-md-6">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" value="{{ old('nome', $cliente->nome ?? '') }}" required>
    </div>
    <div class="col-md-3">
        <label>CPF:</label>
        <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $cliente->cpf ?? '') }}" required>
    </div>
    <div class="col-md-3">
        <label>Telefone:</label>
        <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $cliente->telefone ?? '') }}" required>
    </div>

    <div class="col-md-3">
        <label>CEP:</label>
        <input type="text" name="cep" id="cep" class="form-control" value="{{ old('cep', $cliente->cep ?? '') }}" required>
    </div>
    <div class="col-md-5">
        <label>Rua:</label>
        <input type="text" name="rua" id="rua" class="form-control" value="{{ old('rua', $cliente->rua ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label>Bairro:</label>
        <input type="text" name="bairro" id="bairro" class="form-control" value="{{ old('bairro', $cliente->bairro ?? '') }}" required>
    </div>

    <div class="col-md-3">
        <label>Número:</label>
        <input type="text" name="numero" class="form-control" value="{{ old('numero', $cliente->numero ?? '') }}" required>
    </div>
    <div class="col-md-5">
        <label>Complemento:</label>
        <input type="text" name="complemento" class="form-control" value="{{ old('complemento', $cliente->complemento ?? '') }}">
    </div>
    <div class="col-md-4">
        <label>Cidade:</label>
        <input type="text" name="cidade" id="cidade" class="form-control" value="{{ old('cidade', $cliente->cidade ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label>Estado:</label>
        <select name="estado" id="estado" class="form-select" required>
            <option value="">Selecione um estado</option>
            @php
                $estados = [
                    'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
                    'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
                    'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
                    'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
                    'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
                    'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
                    'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins',
                ];
            @endphp
            @foreach ($estados as $sigla => $nome)
                <option value="{{ $sigla }}" {{ old('estado', $cliente->estado ?? '') == $sigla ? 'selected' : '' }}>
                    {{ $nome }}
                </option>
            @endforeach
        </select>
    </div>
</div>
