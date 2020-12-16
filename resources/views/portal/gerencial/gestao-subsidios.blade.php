@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')
<style>
@media (min-width: 768px) {
  .modal-xl {
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
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Gestão Subsídios Jurir
        </h1>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Gerencial</li>
            <li class="breadcrumb-item active"> Gestão Subsídios Jurir</li>
        </ol>
    </div>
</div>

@stop


@section('content')
<p>Data e hora da captura: <b><span id="dataHoraCaptura"></span></p></b>

{{-- <div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="notice notice-success">
                            <strong>Subsídios JURIR </strong> 
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item nav-card" id="custon-tabs-li-pendentes">
                        <a class="nav-link active" id="custom-tabs-one-pendentes-tab" data-toggle="pill" href="#custom-tabs-one-pendentes" role="tab" aria-controls="custom-tabs-one-pendentes" aria-selected="true">
                            <h5>Pendentes a Distribuir</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="custon-tabs-li-distribuidos">
                        <a class="nav-link" id="custom-tabs-one-distribuidos-tab" data-toggle="pill" href="#custom-tabs-one-distribuidos" role="tab" aria-controls="custom-tabs-one-distribuidos" aria-selected="false">
                            <h5>Pendentes em Tratamento</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="custon-tabs-li-tratados">
                        <a class="nav-link" id="custom-tabs-one-tratados-tab" data-toggle="pill" href="#custom-tabs-one-tratados" role="tab" aria-controls="custom-tabs-one-tratados" aria-selected="false">
                            <h5>Tratados</h5>
                        </a>
                    </li>

                </ul>               
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-pendentes" role="tabpanel" aria-labelledby="custom-tabs-one-pendentes-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="notice notice-success">
                                        <strong>Subsídios Pendentes: </strong> Demandas não tratadas e não distribuídas. 
                                        <a href="/contratacao/controle-boletos/baixar-planilha-boletos"><button style="float: right" type="button" class="btn btn-success">Baixar a Planilha dos Subsídios &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                                    </div><br>
                                    <div id="displayAberto">
                                        <div class="col">
                                            <table id="tblSijurPendentes" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Multa</th>
                                                        <th>Prazo Jurir</th>
                                                        <th>Sequencial</th>
                                                        <th>Contrato Cadastrado no JURIR</th>
                                                        <th> </th>
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
          
                                  
                    <div class="tab-pane fade" id="custom-tabs-one-distribuidos" role="tabpanel" aria-labelledby="custom-tabs-one-distribuidos-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="notice notice-success">
                                        <strong>Subsídios Pendentes: </strong> Demandas não tratadas, já distribuídas no Atende. 
                                        <a href="/contratacao/controle-boletos/baixar-planilha-boletos"><button style="float: right" type="button" class="btn btn-success">Baixar a Planilha dos Subsídios em Tratamento&nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                                    </div><br>
                                    <div class="col">
                                        <table id="tblSijurDistribuidos" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Multa</th>
                                                <th>Prazo Jurir</th>
                                                <th>Sequencial</th>
                                                <th>Contrato Cadastrado no JURIR</th>
                                                <th>Analista</th>
                                                <th>Área de Atuação</th>
                                                <th>Distribuído em</th> <!--Data da distribuição-->
                                                <th>Atende</th> <!--nº do atende-->
                                                <th>Prazo Analista</th>
                                                <th> </th>
                                                
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


                    <div class="tab-pane fade" id="custom-tabs-one-tratados" role="tabpanel" aria-labelledby="custom-tabs-one-tratados-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="notice notice-warning">
                                        <strong>Finalizados: </strong> Últimos 250 subsídios finalizados
                                    </div><br>
                                <div class="col">
                                    <table id="tblSijurTratados" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Multa</th>
                                                <th>Prazo Jurir</th>
                                                <th>Sequencial</th>
                                                <th>Contrato Cadastrado no JURIR</th>
                                                <th>Analista</th>
                                                <th>Área de Atuação</th>
                                                <th>Distribuído em</th> <!--Data da distribuição-->
                                                <th>Atende</th> <!--nº do atende-->
                                                <th>Prazo Analista</th>
                                                <th>Respondido em</th> <!--data da resposta do atende-->
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
</div>



@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
<script src="{{ asset('js/portal/sijur/sijur.js') }}"></script>
@stop
