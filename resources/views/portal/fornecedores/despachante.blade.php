@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col">
        <h1 class="m-0 text-dark">
            Controle Despachantes
        </h1>
    </div><br>

    <div class="col-sm-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraDespachante">
                <i class="far fa-lg fa-edit"></i>
                Cadastrar Despachante
            </button>
</div><br>

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
                                        <th> </th>
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

<div class="modal fade" id="modalCadastraDespachante" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method='post' action='/fornecedores/controle-despachantes' id="formCadastraDemandaDespachante">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Cadastrar Despachante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-0">
                        <div style="overflow-y: hidden; height: calc(100vh - 15rem);">
                        <div class="px-2" style="overflow-y: auto; height: 100%;">
                    
                        <div class="form-group">
                            <label>Contrato:</label>
                            <input type="text" name="numeroContrato" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Data de vencimento do contrato:</label>
                            <input type="text" name="dataVencimentoContrato" id="dataVencimentoContrato" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>CNPJ:</label>
                            <input type="text" name="cnpjDespachante" class="form-control" id="cnpjDespachante" placeholder="00.000.000/0000-00" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Despachante:</label>
                            <input type="text" name="nomeDespachante" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Telefone:</label>
                            <input type="text" name="telefoneDespachante" class="form-control" id="telefoneDespachante" placeholder="(xx) xxxx-xxxx" required>
                        </div>

                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" name="emailDespachante" class="form-control" placeholder="exemplo@email.com.br" required>
                        </div>

                        <div class="form-group">
                            <label>Nome do responsável:</label>
                            <input type="text" name="nomePrimeiroResponsavelDespachante" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Telefone do responsável:</label>
                            <input type="text" name="telefonePrimeiroResponsavelDespachante" class="form-control" id="telefonePrimeiroResponsavelDespachante" placeholder="(xx) xxxxx-xxxx" required>
                        </div>

                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" name="emailPrimeiroResponsavelDespachante" class="form-control" placeholder="exemplo@email.com.br" required>
                        </div>
                     
                        <div class="form-group">
                            <label>Nome do segundo responsável:</label>
                            <input type="text" name="nomeSegundoResponsavelDespachante" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Telefone do segundo responsável:</label>
                            <input type="text" name="telefoneSegundoResponsavelDespachante" class="form-control" id="telefoneSegundoResponsavelDespachante" placeholder="(xx) xxxxx-xxxx">
                        </div>

                        <div class="form-group">
                            <label>E-mail do seundo responsável:</label>
                            <input type="email" name="emailSegundoResponsavelDespachante" class="form-control" placeholder="exemplo@email.com.br">
                        </div>

                        <div class="form-group">
                            <label>Nome do terceiro responsável:</label>
                            <input type="text" name="nomeTerceiroResponsavelDespachante" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Telefone do terceiro responsável:</label>
                            <input type="text" name="telefoneTerceiroResponsavelDespachante" class="form-control" id="telefoneTerceiroResponsavelDespachante" placeholder="(xx) xxxxx-xxxx">
                        </div>

                        <div class="form-group">
                            <label>E-mail do terceiro responsável:</label>
                            <input type="email" name="emailTerceiroResponsavelDespachante" class="form-control" placeholder="exemplo@email.com.br">
                        </div>
                    </div>
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

 

  <!-- Modal da ação -->
<div class="modal fade" id="exampleModalteste" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro completo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
    <p><b>NOME:</b> <span class="pl-5" id="nome_despachante"></span></p>
    <p><b>Telefone:</b> <span class="pl-3" id="telefone_despachante"></span></p>
    <p><b>E-MAIL:</b> <span class="pl-3" id="email_despachante"></span></p>
    <p><b>CNPJ:</b> <span class="pl-3" id="cnpj_despachante"></span></p>
    <p><b>Nº do contrato:</b> <span class="pl-3" id="numero_contrato"></span></p>
    <p><b>Vencimento do contrato:</b> <span class="pl-3" id="vencimento_contrato"></span></p>
    <p><b>Responsável:</b> <span class="pl-3" id="nome_responsavel"></span></p>
    <p><b>Telefone/Responsável:</b> <span class="pl-3" id="telefone_responsavel"></span></p>
    <p><b>E-mail/Responsável:</b> <span class="pl-3" id="email_responsavel"></span></p>
    
</div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script>
var gilie = $('#lotacao').text()

$(document).ready(function(){
$.getJSON('/fornecedores/controle-despachantes/listar-despachantes/' + gilie, function(dados){
    $.each(dados, function(key, item) {
    var linha =
            '<tr>' +
                '<td>' + item.idDespachante + '</td>' +
                '<td>' + item.nomeDespachante + '</td>' +
                '<td>' + item.numeroContrato + '</td>' +
                '<td>' + item.dataVencimentoContrato + '</td>' +
                '<td>' + item.cnpjDespachante + '</td>' +
                '<td>' + '<div class="btn-group" role="group">' +
                '<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                'Ação' + '</button>' + '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">' +
                '<a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalteste">' + '<i class="fa fa-search" aria-hidden="true">' + '</i>' + ' Consultar' + '</a>' +
                '<a class="dropdown-item" href="#">' + '<i class="far fa-edit">' + '</i>' + ' Editar' + '</a>' +
                '<a class="dropdown-item" href="#">' + '<i class="far fa-trash-alt">' + '</i>' + ' Remover</a>' +
                '</div>' + '</div>' + '</td>' +
                '</tr>';
                
    $(linha).appendTo('#tblfornecedores>tbody');
    $('#nome_despachante').text(item.nomeDespachante)
    $('#numero_contrato').text(item.numeroContrato)
    $('#vencimento_contrato').text(item.dataVencimentoContrato)
    $('#cnpj_despachante').text(item.cnpjDespachante)
    $('#telefone_despachante').text(item.telefoneDespachante)
    $('#email_despachante').text(item.emailDespachante)
    $('#nome_responsavel').text(item.nomePrimeiroResponsavelDespachante)
    $('#telefone_responsavel').text(item.telefonePrimeiroResponsavelDespachante)
    $('#email_responsavel').text(item.emailPrimeiroResponsavelDespachante)
    })
 }).done(function() { 
    _formataDatatable();
    _formataData();
 })
})


    $("#telefoneDespachante").mask("(00) 0000-0000");
    $("#cnpjDespachante").mask("99.999.999/9999-99");
    $("#telefonePrimeiroResponsavelDespachante").mask("(00) 00000-0000");
    $("#dataVencimentoContrato").mask("0000-00-00");

</script>
@stop
