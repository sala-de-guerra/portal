@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
           Demo API
        </h1>
    </div>
</div>


@stop


@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title"><b>URL:</b> http://10.123.8.177:3011/atende/integracao/novaSolicitacao
                    &nbsp &nbsp &nbsp &nbsp  <b>Rota:</b> https://portal.gilie.des.sp.caixa/api/atende-suban/rota-gilie
                </h3>
            </div> <!-- /.card-header -->
            
                <div class="card-body">
                    <div class="notice notice-danger">
                        <div id="apiGilie"></div>
                    </div>
                
            </div> <!-- /.card-body -->

            <div class="card-header">
                <h3 class="card-title"><b>URL:</b> http://10.123.8.177:3011/atende/integracao/listarCategorias
                    &nbsp &nbsp &nbsp &nbsp  <b>Rota:</b> https://portal.gilie.des.sp.caixa/api/atende-suban/rota-cemob
                </h3>
            </div> <!-- /.card-header -->
            
            <div class="card-body">
                <table id="apiCemob" class="table table-bordered table-striped dataTable">
                    <thead>
                       <tr>
                           <th>ID</th>
                           <th>Nome</th>
                           <th>Descrição</th>
                       </tr>
                   </thead>
                       <tbody>

                       </tbody>

                </table>
                
            </div> <!-- /.card-body -->

            <div class="card-header">
                <h3 class="card-title"><b>URL:</b> http://10.123.8.177:3011/atende/integracao/demandasPendentes/'2020-11-12'
                    &nbsp &nbsp &nbsp &nbsp  <b>Rota:</b> https://portal.gilie.des.sp.caixa/api/atende-suban/lista-atende
                </h3>
            </div> <!-- /.card-header -->
            
            <div class="card-body">
                <table id="apilistaAtende" class="table table-bordered table-striped dataTable">
                    <thead>
                       <tr>
                           <th>Lista Atende</th>
                       </tr>
                   </thead>
                       <tbody>
                            <tr>
                                <td>SEM INFORMAÇÃO</td>
                            </tr>
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

<script>
$(document).ready(function(){
        $.getJSON('/api/atende-suban/rota-cemob', function(dados){
            $.each(dados, function(key, item) {
                var linha =
                    `<tr>
                        <td>${item._id}</td>
                        <td>${item.nome}</td>
                        <td>${item.descricao}</td>
                    </tr>`;          
        $(linha).appendTo('#apiCemob>tbody');
            }
        )}
    )

    $.getJSON('/api/atende-suban/rota-gilie', function(dados){
            $.each(dados, function(key, item) {
                var erro = `<p><b>ERRO LARAVEL: </b> ${item}</p>`
            $(erro).appendTo('#apiGilie');
            }
        )}
    )
})

</script>


@stop
