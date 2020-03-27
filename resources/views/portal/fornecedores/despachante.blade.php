@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col">
        <h1 class="m-0 text-dark">
            Controle Despachantes
        </h1>
    </div>

    <div class="col-sm-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraDespachante">
                <i class="far fa-lg fa-edit"></i>
                Cadastrar Despachante
            </button>
</div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> Fornecedores</li>
            <li class="breadcrumb-item active"><a href="/fornecedores/controle-despachantes"> Controle Despachantes</a> </li>
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
                            <table id="tblfornecedores" class="table table-bordered table-striped dataTable">
                                 <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Despachante</th>
                                        <th>Contrato</th>
                                        <th>Data de vencimento do contrato</th>
                                        <th>CNPJ</th>
                                        <th>Responsavel</th>
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

<div class="modal fade" id="modalCadastraDespachante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method='post' action='#####FALTACOLOCAR######' id="formCadastraDemandaDespachante">
                {{ csrf_field() }}                 
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Despachante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Despachante:</label>
                            <input type="text" name="Despachante" class="form-control" id="inputDespachante" required>
                        </div>

                        <div class="form-group">
                            <label>Contrato:</label>
                            <input type="text" name="nomeProponente" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Data de vencimento do contrato:</label>
                            <input type="text" name="cpfCnpjProponente" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>CNPJ:</label>
                            <input type="text" name="cpfCnpjProponente" class="form-control" placeholder="00.000.000/0000-00" required>
                        </div>

                        <div class="form-group">
                            <label>Nome do responsavel:</label>
                            <input type="text" name="cpfCnpjProponente" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop 


@section('content')



@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
<script>
$(document).ready(function(){
$.getJSON('/fornecedores/controle-despachantes/listar-despachantes/7257', function(dados){
    $.each(dados, function(key, item) {
    var linha =
            '<tr>' +
                '<td>' + item.idDespachante + '</td>' +
                '<td>' + item.nomeDespachante + '</td>' +
                '<td>' + item.numeroContrato + '</td>' +
                '<td>' + item.dataVencimentoContrato + '</td>' +
                '<td>' + item.cnpjDespachante + '</td>' +
                '<td>' + item.nomePrimeiroResponsavelDespachante + '</td>' +
                '</tr>';
    $(linha).appendTo('#tblfornecedores>tbody');
    })
 }).done(function() { 
    _formataDatatable();
 })
})
</script>
@stop
