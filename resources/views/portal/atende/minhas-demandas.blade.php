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


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">       
            <div class="card-body">
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblminhasDemandas" class="table table-bordered table-striped dataTable">
                                 <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Atividade</th>
                                        <th>Limite atendimento</th>
                                        <th>Contrato</th>
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
</div> <!-- /.row -->


 @stop 


@section('content')



@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
 
@stop


@section('js')
<script src="{{ asset('js/global/formata-datable-dataVencimento.js') }}"></script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/portal/atende/minhas-demandas.js') }}"></script>
@stop
