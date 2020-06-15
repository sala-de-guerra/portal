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
            Fale Conosco
        </h1>
    </div><br>


    <div class="col">
        <ol class="breadcrumb float-right">
           <li class="breadcrumb-item active"><i class="fa fa-map-signs"></i> <a href="/atende/abrir"> Fale Conosco</a> </li> 
        </ol>
    </div>
</div><br>

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">       
            <div class="card-body">
                <h4>Escolha o assunto desejado:</h4><br>
                <div class="col-sm-12 table-responsive p-0">
                    <table id="tblAtendeGenerico" class="table hover">
                        <thead>
                            <tr>
                                <th>Assunto</th>
                                <th>Enviar Pergunta</th>
                                <!-- <th>Botão provisório</th> -->


                                <!-- <th>Vencimento</th> -->
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                        
                    </table>
                </div> <!-- /.col-sm-12 -->
    
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
<script src="{{ asset('js/portal/atende/fale-conosco-criar.js') }}"></script>
@stop
