@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Alunos</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> Pólos</h4>
      <p class="mg-b-0">Lista de pólos cadastrados no sistema</p>

     <a href="{{ route('sistema.polo.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar pólo</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $polos->count() }} pólos</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome do pólo</th>
                <th>Tipo</th>
                <th>Cidade</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($polos as $polo)
              <tr>
                <th scope="row">{{ $polo->id }}</th>
                <td>{{ $polo->nome }}</td>
                <td>{{ $polo->tipo_polo }}</td>
                <td>{{ $polo->endereco->cidade->nome_cidade }} - {{ $polo->endereco->cidade->estado->uf_estado }}</td>
                <td>
                  <a href="{{ url('sistema/polo/'.$polo->id.'/equipe') }}"><div class="btn btn-success"><i class="icon ion-person-stalker"></i> Gerenciar Equipe</div></a>
                  <a href="{{ url('sistema/polo/'.$polo->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirPolo" data-id="{{ $polo->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/polos/index.js') }}"></script>


@endsection