@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Configurações</a>
        <a class="breadcrumb-item" href="#">Regiões</a>
        <span class="breadcrumb-item active">Editar</span>
      </nav>
    </div><!-- br-pageheader -->

 
    <div class="br-pagebody">
        <div class="br-section-wrapper">

            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-bank"></i> Editar Região</h6>
            <p class="mg-b-30 tx-gray-600">Preencha os dados abaixo para editar</p>

            <div class="form-layout form-layout-2">
            <form name="FormRegiao" id="FormRegiao" action="{{ route('sistema.regiao.update') }}" method="POST">
                @csrf
                @php $acao = "editar"; @endphp
                @include('sistema.regioes.form')
                <input type="hidden" name="id" value="{{ $regiao->id ?? '' }}">
                <button type="button" onclick="EnviarFormRegiao();" class="btn btn-info btn-gravar"> <i class="fa fa-save"></i> Atualizar região</button>
            </form>
            </div><!-- form-layout -->

        </div><!-- br-section-wrapper -->
    </div><!-- br-pagebody -->
    <script src="{{ asset('assets/sistema/js/regioes/index.js') }}"></script>
@endsection