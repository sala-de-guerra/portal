@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

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
            Minhas Demandas
        </h1>
    </div><br>


    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"><i class="fa fa-map-signs"></i></i> Atende</li>
            <li class="breadcrumb-item active"><a href="/atende/minhas-demandas"> Minhas Demandas</a> </li>    
        </ol>
    </div>
</div><br>


{{-- <div class="row">
    <div class="col-md-12">
        <div class="card card-default">       
            <div class="card-body">
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblminhasDemandas" class="table table-bordered table-striped dataTable">
                                 <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Atividade</th>
                                        <th>Limite atendimento</th>
                                        <th>Assunto</th>
                                        <th>Breve descrição</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                    <tbody>

                                    </tbody>
      
                             </table>
                        </div>
                    </div>
                </div>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row --> --}}


 @stop 


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" id="custon-tabs-li-minhasDemandas">
                        <a class="nav-link" id="custom-tabs-one-minhasDemandas-tab" data-toggle="pill" href="#custom-tabs-one-minhasDemandas" role="tab" aria-controls="custom-tabs-one-minhasDemandas" aria-selected="true">
                            <h5>Atende com contrato</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-faleConosco">
                        <a class="nav-link" id="custom-tabs-one-faleConosco-tab" data-toggle="pill" href="#custom-tabs-one-faleConosco" role="tab" aria-controls="custom-tabs-one-faleConosco" aria-selected="false">
                            <h5>Atende sem contrato</h5>
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

            <div class="tab-pane fade show active" id="custom-tabs-one-minhasDemandas" role="tabpanel" aria-labelledby="custom-tabs-one-minhasDemandas-tab">
        
        
                <div id="accordion">
                    
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                          <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Em Análise &nbsp<span class="badge badge-light" id="badgeDemandaAgencia">Carregando</span>
                          </button>
                        </h5>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="tblminhasDemandasAgencia" class="table table-bordered table-striped dataTable"> 
        
                                            <thead>
                                                <tr>
                                                    <th>Nº Atende</th>
                                                    <th>Contrato</th>
                                                    <th>Limite atendimento</th>
                                                    <th>Assunto</th>
                                                    <th>Breve descrição</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <br>
                        </div>
                      </div>
                    
                    
                      <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                          <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Finalizado &nbsp<span class="badge badge-light" id="badgeDemandaAgenciaFinalizado">Carregando</span>
                          </button>
                        </h5>
                      </div>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="tblminhasDemandasFinalizado" class="table table-bordered table-striped dataTable"> 
                                           
                                            <thead>
                                                <tr>
                                                    <th>Nº Atende</th>
                                                    <th>Contrato</th>
                                                    <th>Assunto</th>
                                                    <th>Breve descrição</th>
                                                    <th>Resposta</th>
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

          
        <div class="tab-pane fade" id="custom-tabs-one-faleConosco" role="tabpanel" aria-labelledby="custom-tabs-one-faleConosco-tab">
                        
            <div id="accordion">
                    
                <div class="card-header" id="headingDois">
                  <h5 class="mb-0">
                    <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapsedois" aria-expanded="false" aria-controls="collapsedois">
                      Em Análise &nbsp<span class="badge badge-light" id="badgeDemandaSemContrato">Carregando</span>
                    </button>
                  </h5>
                </div>
                <div id="collapsedois" class="collapse" aria-labelledby="headingDois" data-parent="#accordion">
                  <div class="card-body">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-sm-12">
                                <table id="tblFaleconoscoAgencia" class="table table-bordered table-striped dataTable"> 

                                    <thead>
                                        <tr>
                                            <th>Nº Atende</th>
                                            <th>Atividade</th>
                                            <th>Limite atendimento</th>
                                            <th>Assunto</th>
                                            <th>Breve descrição</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
        
                                    </tbody>
                                </table>
                              </div>
                          </div>
                      </div>
                  <br>
                  </div>
                </div>
              
              
                <div class="card-header" id="headingTres">
                  <h5 class="mb-0">
                    <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseTres" aria-expanded="false" aria-controls="collapseTres">
                      Finalizado &nbsp<span class="badge badge-light" id="badgeFinalizado">Carregando</span>
                    </button>
                  </h5>
                </div>
                <div id="collapseTres" class="collapse" aria-labelledby="headingTres" data-parent="#accordion">
                  <div class="card-body">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-sm-12">
                                <table id="tblFaleconoscoAgenciaFinalizado" class="table table-bordered table-striped dataTable"> 

                                    <thead>
                                        <tr>
                                            <th>Nº Atende</th>
                                            <th>Atividade</th>
                                            <th>Limite atendimento</th>
                                            <th>Assunto</th>
                                            <th>Breve descrição</th>
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
            </div> {{-- <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tblFaleconoscoAgencia" class="table table-bordered table-striped dataTable"> 

                                        <thead>
                                            <tr>
                                                <th>Nº Atende</th>
                                                <th>Atividade</th>
                                                <th>Limite atendimento</th>
                                                <th>Assunto</th>
                                                <th>Breve descrição</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>--}}
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
<script src="{{ asset('js/global/formata-datable-dataVencimento.js') }}"></script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/portal/atende/minhas-demandas-agencia.js') }}"></script>
{{-- <script src="{{ asset('js/portal/atende/fale-conosco-tratar.js') }}"></script> --}}
@stop
