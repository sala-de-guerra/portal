@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Tempo Médio Venda à Vista
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Venda à vista</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">TMA Venda à Vista</h3>
            </div> <!-- /.card-header -->
            
            <div class="card-body">
                <div class="notice notice-warning">
                    <strong>TMA: </strong> .
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
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
               

            </div> <!-- /.card-body -->
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
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/portal/tma/tma.js') }}"></script>


@stop
