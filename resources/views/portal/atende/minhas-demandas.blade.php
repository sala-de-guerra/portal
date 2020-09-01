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
            <li class="breadcrumb-item active"> Atende</li>
            <li class="breadcrumb-item active"><a href="/atende/minhas-demandas"> Minhas Demandas</a> </li>    
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
                    <li class="nav-item nav-card" id="custon-tabs-li-minhasDemandas">
                        <a class="nav-link active" id="custom-tabs-one-minhasDemandas-tab" data-toggle="pill" href="#custom-tabs-one-minhasDemandas" role="tab" aria-controls="custom-tabs-one-minhasDemandas" aria-selected="true">
                            <h5>Atende com contrato</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="custon-tabs-li-faleConosco">
                        <a class="nav-link" id="custom-tabs-one-faleConosco-tab" data-toggle="pill" href="#custom-tabs-one-faleConosco" role="tab" aria-controls="custom-tabs-one-faleConosco" aria-selected="false">
                            <h5>Atende sem contrato</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="">
                        <a style="display: none;" class="nav-link" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>

                    <li class="nav-item nav-card" id="">
                        <a class="nav-link" style="display: none;" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>
                    
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show active" id="custom-tabs-one-minhasDemandas" role="tabpanel" aria-labelledby="custom-tabs-one-minhasDemandas-tab">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="displayAberto">
                                    <table id="tblminhasDemandas" class="table table-bordered table-striped dataTable">
                                        <div class="notice notice-warning">
                                            <strong>Atende: </strong> Demandas para responder.<button style="float: right;" type="button" class="btn btn-primary pb-2" id="btnFinalizado">Ver demandas finalizadas</button>
                                        </div><br>
                                        <thead>
                                            <tr>
                                                <th>Nº Atende</th>
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

                                <div id="displayFechado" style="display: none">
                                    <table id="tblFinalizados" class="table table-bordered table-striped dataTable">
                                        <div class="notice notice-success">
                                            <strong>Atende: </strong> Últimas 20 demandas finalizadas.<button style="float: right;" type="button" class="btn btn-primary pb-2" id="btnAbertas">Ver demandas abertas</button>
                                        </div><br>
                                        <thead>
                                            <tr>
                                                <th>Nº Atende</th>
                                                <th>Contrato</th>
                                                <th>Atividade</th>
                                                <th>Respondido em</th>
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
          

        <div class="tab-pane fade" id="custom-tabs-one-faleConosco" role="tabpanel" aria-labelledby="custom-tabs-one-faleConosco-tab">
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tblFaleconosco" class="table table-bordered table-striped dataTable"> 

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
<script src="{{ asset('js/portal/atende/minhas-demandas.js') }}"></script>
<script src="{{ asset('js/portal/atende/fale-conosco-tratar.js') }}"></script>
@stop
