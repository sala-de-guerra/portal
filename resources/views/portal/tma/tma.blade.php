@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')
<style>
@media (min-width: 768px) {
  .modal-xxl {
    width: 90%;
   max-width:1200px;
  }
}
</style>

@if (session('tituloMensagem'))
<div id="fadeOut" class="card text-white bg-{{ session('corMensagem') }}">
    <div class="card-header">
        <div class="card-body">
            <h5 class="card-title"><strong>{{ session('tituloMensagem') }}</strong></h5>
            <br>
            <p class="card-text">{{ session('corpoMensagem') }}</p>
        </div>
    </div>
</div>
@endif

<div class="row mb-2">
    <div class="col">
        <h1 class="m-0 text-dark">
            Tempo médio de atendimento 
        </h1>
    </div><br>


    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/estoque-imoveis/conformidade-contratacao">Contratação</a> </li>
            <li class="breadcrumb-item active"><a href=""> TMA</a> </li>    
        </ol>
    </div>
</div><br>

@stop 


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" id="custon-tabs-li-tmaAvista">
                        <a class="nav-link" id="custom-tabs-one-tmaAvista-tab" data-toggle="pill" href="#custom-tabs-one-tmaAvista" role="tab" aria-controls="custom-tabs-one-tmaAvista" aria-selected="true">
                            @foreach ($mediaAVista as $media)
                                <h5>À vista</h5>
                                @endforeach
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-tmaFinanciado">
                        <a class="nav-link" id="custom-tabs-one-tmaFinanciado-tab" data-toggle="pill" href="#custom-tabs-one-tmaFinanciado" role="tab" aria-controls="custom-tabs-one-tmaFinanciado" aria-selected="false">
                            <h5>Financiado</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="">
                        <a style="display: none;" class="nav-link" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="">
                        <a class="nav-link" style="display: none;" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>
                    
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show active" id="custom-tabs-one-tmaAvista" role="tabpanel" aria-labelledby="custom-tabs-one-tmaAvista-tab">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="notice notice-success">
                                    @foreach ($mediaAVista as $media)
                                        <strong>TMA: {{$media->media}}</strong>
                                    @endforeach
                                </div><br>
                                <div id="displayAberto">
                                    <div class="col">
                                        <strong>Legenda:</strong>
                                          <i style="color: blue;" class="fas fa-square"></i> <span style="color: blue;">Baixa sinalizada</span> &nbsp&nbsp&nbsp
                                          <i style="color: red;" class="fas fa-square"></i> <span style="color: red;">Distrato sinalizado</span> &nbsp&nbsp&nbsp
                                          <i style="color: green;" class="fas fa-square"></i> <span style="color: green;">Aguarda pagamento</span>
                                          <b style="color: red;">*</b> Proponente com mais de uma proposta
                                      </div><br>
                                    <table id="tblTma" class="table table-bordered table-striped dataTable">
                                        <div class="spinner-border spinnerTbl text-primary" role="status">
                                            <span class="sr-only"></span>
                                          </div>
                                          <span class="spinnerTbl">Carregando Tabela Aguarde...</span>
                    
                                        <thead>
                                            <tr>
                                                <th>Contrato</th>
                                                <th>Classificação</th>
                                                <th>Pagamento Boleto</th>
                                                <th>Dias Decorridos</th>
                                                <th>Nome Proponente</th>
                                                <th>CPF/CNPJ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                    
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
          

        <div class="tab-pane fade" id="custom-tabs-one-tmaFinanciado" role="tabpanel" aria-labelledby="custom-tabs-one-tmaFinanciado-tab">
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="notice notice-success"> 
                                        @foreach ($mediaComFinanciamento as $mediaFinanciada)
                                            <strong>TMA: {{$mediaFinanciada->media}}</strong>
                                        @endforeach
                                        &nbsp&nbsp&nbsp&nbsp&nbsp
                                        @foreach ($mediaCCA as $mediaApenasCCA)
                                        <strong>TMA CCA: {{$mediaApenasCCA->media}}</strong>
                                    @endforeach
                                    </div><br>
                                    <div class="col">
                                        <strong>Legenda:</strong>
                                          <i style="color: blue;" class="fas fa-square"></i> <span style="color: blue;">Baixa sinalizada</span> &nbsp&nbsp&nbsp
                                          <i style="color: red;" class="fas fa-square"></i> <span style="color: red;">Distrato sinalizado</span> &nbsp&nbsp&nbsp
                                          <i style="color: green;" class="fas fa-square"></i> <span style="color: green;">Aguarda pagamento</span>
                                          <b style="color: red;">*</b> Proponente com mais de uma proposta
                                      </div><br>
                                    <table id="tblTmaFinanciado" class="table table-bordered table-striped dataTable">
                                        <div class="spinner-border spinnerTbl text-primary" role="status">
                                            <span class="sr-only"></span>
                                          </div>
                                          <span class="spinnerTbl">Carregando Tabela Aguarde...</span>
                    
                                        <thead>
                                            <tr>
                                                <th>Contrato</th>
                                                <th>Classificação</th>
                                                <th>Pagamento Boleto</th>
                                                <th>Dias Decorridos</th>
                                                <th>Nome Proponente</th>
                                                <th>CPF/CNPJ</th>
                                                <th>CCA</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                    
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
 
@stop


@section('js')
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/portal/tma/tma.js') }}"></script>
<script src="{{ asset('js/portal/tma/tma-financiado.js') }}"></script>
@stop
