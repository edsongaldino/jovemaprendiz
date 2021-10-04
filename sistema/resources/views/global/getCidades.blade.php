<label class="form-control-label">Cidade: <span class="tx-danger">*</span></label>
<select class="form-control" name="cidade_endereco" data-placeholder="Selecione a cidade" required>
    <option label="Selecione a cidade"></option>
    @foreach ($cidades as $cidade)
    <option value="{{ $cidade['id'] }}">{{ $cidade['nome_cidade'] }}</option>
    @endforeach
</select>
