<div class="row no-gutters">

    <div class="col-md-12">
        <div class="form-group">
        <label class="form-control-label">Selecione o pólo responsável por esse contrato: <span class="tx-danger">*</span></label>
        <select class="form-control" id="polo_id" name="polo_id" data-placeholder="Selecione o pólo responsável">
            <option label="Selecione o pólo responsável"></option>
            @foreach ($polos as $polo)
            <option value="{{ $polo->id }}" @if(($polo->id ?? '') == ($contrato->polo_id ?? '')) selected @endif>{{ $polo->nome }}</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">CNPJ (Empresa): <span class="tx-danger">*</span></label>
        <input class="form-control cnpj" type="text" name="nome" value="{{ $contrato->empresa->cnpj ?? '' }}" placeholder="CNPJ da Empresa" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Selecione a empresa ou Digite o CNPJ: <span class="tx-danger">*</span></label>
        <select class="form-control" id="empresa_id" name="empresa_id" data-placeholder="Selecione a empresa">
            <option label="Selecione a empresa"></option>
            @foreach ($empresas as $empresa)
            <option value="{{ $empresa->id }}" @if(($empresa->id ?? '') == ($contrato->polo_id ?? '')) selected @endif>{{ $empresa->razao_social }} ({{ $empresa->nome_fantasia }})</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">CPF (Aluno): <span class="tx-danger">*</span></label>
        <input class="form-control cpf" type="text" name="cpf" value="{{ $contrato->aluno->cpf ?? '' }}" placeholder="CPF do Aluno" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Selecione o aluno ou Digite o CPF: <span class="tx-danger">*</span></label>
        <select class="form-control" id="aluno_id" name="aluno_id" data-placeholder="Selecione o aluno">
            <option label="Selecione o aluno"></option>
            @foreach ($alunos as $aluno)
            <option value="{{ $aluno->id }}" @if(($aluno->id ?? '') == ($contrato->aluno_id ?? '')) selected @endif>{{ $aluno->nome }}</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Data Inicial: <span class="tx-danger">*</span></label>
        <input class="form-control data" type="text" name="data_inicial" value="{{ Helper::data_br($contrato->data_inicial ?? '') }}" placeholder="Data Inicial" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Data Final: <span class="tx-danger">*</span></label>
        <input class="form-control data" type="text" name="data_final" value="{{ Helper::data_br($contrato->data_final ?? '') }}" placeholder="Data Final" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Selecione o Status: <span class="tx-danger">*</span></label>
        <select class="form-control" id="situacao" name="situacao" data-placeholder="Selecione a situação">
            <option label="Selecione a situação do contrato"></option>
            <option value="Ativo" @if(($contrato->situacao ?? '') == 'Ativo') selected @endif>Ativo</option> 
            <option value="Bloqueado" @if(($contrato->situacao ?? '') == 'Bloqueado') selected @endif>Bloqueado</option> 
            <option value="Cancelado" @if(($contrato->situacao ?? '') == 'Cancelado') selected @endif>Cancelado</option> 
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Selecione a tabela utilizada neste contrato: <span class="tx-danger">*</span></label>
        <select class="form-control" id="tabela_id" name="tabela_id" data-placeholder="Selecione a tabela">
            <option label="Selecione a tabela"></option>
            @foreach ($tabelas as $tabela)
            <option value="{{ $tabela->id }}" @if(($tabela->id ?? '') == ($contrato->tabela_id ?? '')) selected @endif>{{ $tabela->nome }} - ({{ $tabela->valor }})</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->



</div><!-- row -->