@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">

    <div class="col-sm-6">

        <h1 class="m-0 text-dark">
            Controle de Conformidade
        </h1>

    </div>

    <div class="col-sm-6">

        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/controle-conformidade"> Controle de Conformidade</a> </li>
        </ol>

    </div>


</div>

      

@stop


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Conformidade Fluxo Agência</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tblConformidadeAgencia" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>CHB</th>
                                    <th>Proponente</th>
                                    <th>CPF / CNPJ</th>
                                    <th>Status</th>
                                    <th>Origem do Imóvel</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Conformidade Fluxo CCA</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tblConformidadeCca" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>CHB</th>
                                    <th>Proponente</th>
                                    <th>CPF / CNPJ</th>
                                    <th>Status</th>
                                    <th>Origem do Imóvel</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->



@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script>
        _formataDatatable ();
    </script>
@stop