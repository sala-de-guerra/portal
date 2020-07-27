@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Corretores
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">  <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Corretores</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">Listagem de corretores</h3>&nbsp&nbsp
                <div class="spinner-border spinnerTbl text-primary" role="status">
                    <span class="sr-only"></span>
                  </div>
            </div> <!-- /.card-header -->
            
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <table id="tblCorretores" class="table table-bordered table-striped dataTable">
                            <div class="notice notice-success">
                                <strong>Corretores: </strong>Listagem de corretores com contrato <strong>ATIVO</strong> registrado no SIMOV.
                            </div><br>
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

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

<script src="{{ asset('js/portal/informativas/corretores.js') }}"></script>


@stop
