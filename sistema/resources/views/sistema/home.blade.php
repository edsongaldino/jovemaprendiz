@extends('sistema.layout')
@section('conteudo')

    <div class="br-pagebody mg-t-30 pd-x-30 pd-30">
      <div class="row row-sm">
        <div class="col-sm-6 col-xl-4">
          <div class="bg-teal rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-person-stalker tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Contratos Ativos</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">1.325</p>
                <span class="tx-11 tx-roboto tx-white-6">Número total de alunos ativos nas unidades</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-4 mg-t-20 mg-sm-t-0">
          <div class="bg-danger rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-power tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Contratos inativos </p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">300</p>
                <span class="tx-11 tx-roboto tx-white-6">Número total de contratos cancelados ou vencidos</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
          <div class="bg-primary rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="icon ion-pie-graph tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">% Relatório Percentual</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">54.45%</p>
                <span class="tx-11 tx-roboto tx-white-6">23% de aumento em relação ao último mês</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
       
      </div><!-- row -->

      

    </div><!-- br-pagebody -->
@endsection