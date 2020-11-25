@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Controle SAP
        </h1>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Contratação</li>
            <li class="breadcrumb-item active"> Controle SAP</li>
        </ol>
    </div>
</div>


@stop


@section('content')

@if (session('tituloMensagem'))
    <div class="card text-white bg-{{ session('corMensagem') }}">
        <div class="card-header">
            <div class="card-body">
                <h5 class="card-title"><strong>{{ session('tituloMensagem') }}</strong></h5>
                <br>
                <p class="card-text">{{ session('corpoMensagem') }}</p>
            </div>
        </div>
    </div>
@endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
            
                <div class="card-body">
                    <div class="notice notice-success">
                        Lista geral de imóveis em contratação com pendência de lançamento da venda no sistema SAP e Simov. &nbsp &nbsp
                    <a href="/contratacao/controle-sap/baixa-lista-sap-geral"><button style="float: right" type="button" class="btn btn-success">Baixar Planilha Geral &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                    <br>
                    </div><br>

                    <div class="row anima">
                        <strong>Quantidade pendente: <span id="quantidadePendente" style="color: #295dd2"></span> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        Valor pendente de baixa SAP/SIMOV: <span id="totalPendente" style="color: #295dd2" ></span> </strong>                                         
                    </div><br>


                    <table id="tblSap" class="table table-bordered table-striped">
                        <thead>
                       
                        <tr>
                            <th>Gilie</th>
                            <th>Contrato</th> <!--dados do imóvel - criar - colocar endereço, cidade, cep...-->
                            <th>Proponente</th> <!--dados do proponente - criar - colocar CPF...-->
                            <th>Entrada Simov</th> <!--data de entrada do SIMOV-->
                            <th>Objeto Locação</th> <!--nº do objeto de locação-->
                            <th>Imobilizado</th> <!--nº Imobilizado-->
                            <th>Edificio</th> <!--nº Edificio-->
                            <th>Boleto</th> <!--valor do boleto-->
                            <th>Pagamento</th> <!--data de pagamento-->
                        </tr>
                       
                        <tbody>
                        </tbody> 

                        </thead>
                    </table>

                </div>

            </div> <!-- /.card -->

        </div> <!-- /.col -->
    
    </div> <!-- /.row -->


@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script src="{{ asset('js/global/formata-data-datable.js') }}"></script>
    <script src="{{ asset('js/portal/sap/controleSap.js') }}"></script>

@stop
