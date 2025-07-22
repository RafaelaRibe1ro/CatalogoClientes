<div class="row g-3">
    <div class="col-md-6">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" value="{{ old('nome', $cliente->nome ?? '') }}" required>
    </div>
    <div class="col-md-3">
        <label>CPF:</label>
        <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $cliente->cpf ?? '') }}" >
    </div>
    <div class="col-md-3">
        <label>Telefone:</label>
        <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $cliente->telefone ?? '') }}" >
    </div>

    <div class="col-md-3">
        <label>CEP:</label>
        <input type="text" name="cep" id="cep" class="form-control" value="{{ old('cep', $cliente->cep ?? '') }}" >
    </div>
    <div class="col-md-5">
        <label>Rua:</label>
        <input type="text" name="rua" id="rua" class="form-control" value="{{ old('rua', $cliente->rua ?? '') }}" >
    </div>
    <div class="col-md-4">
        <label>Bairro:</label>
        <input type="text" name="bairro" id="bairro" class="form-control" value="{{ old('bairro', $cliente->bairro ?? '') }}" >
    </div>

    <div class="col-md-3">
        <label>Número:</label>
        <input type="text" name="numero" class="form-control" value="{{ old('numero', $cliente->numero ?? '') }}" >
    </div>
    <div class="col-md-5">
        <label>Complemento:</label>
        <input type="text" name="complemento" class="form-control" value="{{ old('complemento', $cliente->complemento ?? '') }}">
    </div>
    <div class="col-md-4">
        <label>Cidade:</label>
        <input type="text" name="cidade" id="cidade" class="form-control" value="{{ old('cidade', $cliente->cidade ?? '') }}" >
    </div>

    <div class="col-md-4">
        <label>Estado:</label>
        <select name="estado" id="estado" class="form-select" >
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

    <div class="col-md-6">
        <label>Categoria:</label>
        <select name="categoria_id" id="categoria_id" class="form-select" >
            <option value="">Selecione uma categoria</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}"
                    {{ old('categoria_id', $cliente->categoria_id ?? '') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label>Subcategoria:</label>
        <select name="subcategoria_id" id="subcategoria_id" class="form-select" >
            <option value="">Selecione uma subcategoria</option>
            {{-- As opções serão preenchidas via JavaScript --}}
        </select>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function carregarSubcategorias(categoriaId, selecionada = null) {
            if (!categoriaId) return;

            fetch(`/api/subcategorias/${categoriaId}`)
                .then(res => res.json())
                .then(subs => {
                    const subSelect = document.getElementById('subcategoria_id');
                    subSelect.innerHTML = '<option value="">Selecione uma subcategoria</option>';
                    subs.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.nome;
                        if (sub.id == selecionada) option.selected = true;
                        subSelect.appendChild(option);
                    });
                });
        }

        const categoriaSelect = document.getElementById('categoria_id');
        categoriaSelect.addEventListener('change', () => {
            carregarSubcategorias(categoriaSelect.value);
        });

        // Carrega subcategorias se for edição
        const catAtual = categoriaSelect.value;
        const subAtual = `{{ old('subcategoria_id', $cliente->subcategoria_id ?? '') }}`;
        if (catAtual) carregarSubcategorias(catAtual, subAtual);
    });
</script>
