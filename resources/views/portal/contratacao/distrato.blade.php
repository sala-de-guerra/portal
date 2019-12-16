@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Distrato
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/distrato"> Distrato</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">
<div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Distratos em Andamento</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div id="tblDistrato" class="col-sm-12 table-responsive p-0">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th>CHB</th>
                                <th>Nome do Comprador</th>
                                <th>CPF / CNPJ</th>
                                <th>Status</th>
                                <th>Motivo</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div> <!-- /.col-sm-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->

    

</div> <!-- /.row -->

<br>

@stop

@section('footer')


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

<script src="{{ asset('js/portal/contratacao/distrato.js') }}"></script>

@stop