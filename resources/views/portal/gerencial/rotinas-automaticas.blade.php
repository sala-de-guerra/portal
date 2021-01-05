@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Rotinas Automáticas
        </h1>
    </div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i><a href="/indicadores/rotinas-automaticas">Indicadores</a></li>
            <li class="breadcrumb-item active"> Rotinas Automáticas</li>
        </ol>
    </div>
</div><br>

@stop

@section('content')

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


    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
            
                <div class="card-body">
                    <div class="notice notice-success">
                        Lista das rotinas a serem atualizadas. &nbsp &nbsp
                    </div><br>

                    <table id="tblRotinas" class="table table-bordered table-striped">
                        <thead>                   
                            <tr>
                                <th>Processo</th>
                                <th>Descrição</th> <!--o que esse botão vai atualizar-->
                                <th>Último Tratamento</th> 
                                <th>Usuário</th> 
                                <th>Histórico</th> <!--algum dado extra para ser mantido em histórico-->
                            </tr>
                        </thead>
                        
                        <tboby>

                        </tbody>

                    </table>

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
    <script src="{{ asset('js/portal/gerencial/rotinas-automaticas.js') }}"></script>

@stop
