@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

<style>
    /* Esconde o input */
input[type='file'] {
  display: none
}

/* Aparência que terá o seletor de arquivo */
.inputFile {
  background-color: green;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  margin: 10px;
  padding: 6px 20px
}

#tblimportexcel 
{    
    table-layout: fixed !important;
    word-wrap:break-word;
    overflow-x: hidden;
}
</style>

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
    <div class="col-sm">
        <h1 class="m-0 text-dark">
            Corretores
        </h1>
    </div>

    <div class="col-sm">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrarCorretor">
                <i class="far fa-lg fa-edit"></i>
                Cadastrar Corretor
            </button>
    </div><br>

    <div class="col-sm">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">  <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Corretores</a> </li>
            <li class="breadcrumb-item active"> Credenciamento</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')
<div class="row">
                            <div class="col-md-12">
                                <div class="card" >
                                    <div class="card-header">
                                    <h5>Controle de Credenciamento dos Corretores feita em colaboração entre as áreas GILIE/SP e CECAT/SP.</h5>
                                    </div> <!-- /.card-header -->



                            <div class="modal-body">
                            <h5>Popover em um modal</h5>
                            <p>Este <a href="#" role="button" class="btn btn-secondary popover-test" title="Título do popover" data-content="O conteúdo do popover é definido aqui.">botão</a> aciona um popover, ao clicar nele.</p>
                            <hr>
                            <h5>Tooltips em um modal</h5>
                            <p><a href="#" class="tooltip-test" title="Tooltip">Este link</a> e <a href="#" class="tooltip-test" title="Tooltip">este outro</a> mostra tooltips, quando passamos o mouse sobre eles.</p>
                            </div>





<div id="accordion" role="tablist" aria-multiselectable="true">
    <div class="card card-primary">
      <div class="card-header" role="tab" id="headingOne"  onclick="mudaColapse()">
        <h5 class="mb-0">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title mt-2" >Como fazer a carga em lote ?</h3>
                </div>
                <div class="col-md-6">
                    <button id="collapse" class="btn btn-primary" style="float: right"><b>expandir</b></button>
                </div>
            </div>
          </a>
        </h5>
      </div>

      <div id="collapseOne" class="collapse no-show" role="tabpanel" aria-labelledby="headingOne">
        <div class="card-block">
        
            <div class="row">
                <div class="col-md-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-justify"><b>1º -</b> Faça o Download do Modelo clicando no link ao lado-> <a href="/download/ControleEnvioEMGEA.xlsx"><span style="color: green;"><b>Clique aqui para baixar</b></a></span><br>
                                            <b>2º - </b> Preencha os dados de envio no site <a href="http://alienar.caixa/doc/CAIXAemgea.aspx" target="_blank">alienar.caixa</a>, copie os dados, cole na planilha e preencha os campos <b>Caixa e Silog</b> <br>
                                            <b>3º - </b>Após preenchimento, salve o arquivo. <br>
                                            <b>4º - </b>Clique em <b>"Escolher o arquivo"</b> procure onde está salva a Planilha<br>
                                            <b>5º - </b>Espere aparecer a mensagem: <span style="color: green"><b>"Arquivo carregado com sucesso"</b></span><br>
                                            <b>6º - </b>Clique em <span style="color: green"><b>Enviar</b></span><br>
                                            <p class="text-justify"><span style="color: red;">*</span> lembre-se sempre de enviar uma planilha<b> NOVA</b> para não enviar informações duplicadas.</p>
                                        </div>
                                    </div>
                                </div>
                                        <form method="POST" action="/controle-arquivos/envia" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            
                                                    {{-- <input type="file" name="arquivo" required><br><br> --}}
                                                    {{-- <label class="inputFile" for='selecao-arquivo'>Selecionar o arquivo &#187;</label>
                                                    <input id='selecao-arquivo' type='file' name="arquivo" required> --}}
                                                    <label for="fupload" class="control-label label-bordered inputFile">Escolher o arquivo</label>
                                                    <div class="nomeArquivo"></div>
                                                    <input type="file" id="fupload" name="arquivo" accept=".xlsx, .xls" class="fupload form-control" />
                                                <br>
                                                    <button type="submit" id="btnEnviar" style="display: none;" class="mb-2 btn btn-success">Enviar &nbsp &nbsp<i class="fas fa-file-upload"></i></button>      
                                        </form>
                                        </div>
                                    </div>
                                </div>           
                            </div>
                        </div>
                    </div>
                </div>

                        
                                    <div class="card-body">

                    <div class="row">

                    <div class="notice notice-success">
                        Lista geral de imóveis em contratação com pendência de lançamento da venda no sistema SAP e Simov. &nbsp &nbsp
                    <a href="/contratacao/controle-sap/baixa-lista-sap-geral"><button style="float: right" type="button" class="btn btn-success">Baixar Planilha Geral &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                    <br>
                    </div><br>

                        <div class="col-sm-12 table-responsive p-0">
                            <table id="tblimportexcel" class="table table-bordered table-striped hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Processo</th>
                                        <th>Credenciado</th>
                                        <th>CPF / CNPJ</th>
                                        <th>Representante</th>
                                        <th>Contrato</th> <!--nº do contrato - preenchido Gilog-->
                                        <th>Convocação</th> <!--data convocação - preenchido Gilog-->
                                        <th>Contrato Devolvido</th> <!--SIM/NÃO - preenchido Gilog-->
                                        <th>E-mail</th>
                                        <th>SICAF</th> <!--pendente/regular - preenchido Gilog-->
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                                
                            </table><br>

                                </div>
                            </div>
                        </div> <!-- /.col-sm-12 -->
                    </div> <!-- /.row -->
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->


 <!-- Modal -->
 <div class="modal fade" id="modalCadastrarCorretor" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method='post' action='/fornecedores/controle-despachantes' id="formCadastraCredenciado">
            {{ csrf_field() }} 
                <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                    <h5 style="color: white;" class="modal-title" id="exampleModalScrollableTitle">Cadastrar Credenciado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-0">
                    <div style="overflow-y: hidden; height: calc(100vh - 15rem);">
                        <div class="px-2" style="overflow-y: auto; height: 100%;">
                            <p style="color: red;">Campos obrigatórios (*)</p>
                            <div class="form-group">
                                <label>Credenciado<span style="color: red;"> *</span> </label>
                                <input type="text" name="nomeCredenciado" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline" required>
                                <input type="radio" id="cnpjCredenciado" name="cnpjCredenciado" class="custom-control-input" value="opcao1" checked>
                                <label class="custom-control-label" for="cnpjCredenciado">CNPJ</label>
                                <input type="text" class="form-control" aria-label="Input text com checkbox" autocomplete="off" placeholder="00.000.000/0000-00">
                            </div>
                            
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="cpfCredenciado" name="cpfCredenciado" class="custom-control-input" value="opcao2">
                                <label class="custom-control-label" for="cpfCredenciado">CPF</label>
                                <input type="text" class="form-control" aria-label="Input text com checkbox" autocomplete="off" placeholder="000.000.000-00">
                            </div>

                            <div class="form-group">
                                <label>Representante<span style="color: red;"> *</span> </label>
                                <input type="text" name="nomeRepresentante" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <label>E-mail credenciado<span style="color: red;"> *</span> </label>
                                <input type="email" name="emailCredenciado" class="form-control" placeholder="exemplo@email.com.br" autocomplete="off" required>
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




@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

<script>$('.table').css({'overflow-x': 'hidden','border': 'none'});</script>
<script src="{{ asset('js\global\formata-data-datable.js') }}"></script>
<script src="{{ asset('js/portal/corretores/credenciamento.js') }}"></script>
<script>
        $(function () {
        $('#fupload').change(function() {
            $('.nomeArquivo').html('<b style="color: green;">Arquivo carregado com sucesso</b>');
            $('.inputFile').remove();
            $('#btnEnviar').show();
        });
    });

function mudaColapse() {
    if($('#collapse').text() == "X" ){
    $('#collapse').text("Expandir")
    }else{
        $('#collapse').text("X")
    }
}
</script>

<script>
    setTimeout(function(){
        $('.bg-danger').fadeOut("slow");
        $('.bg-success').fadeOut("slow");
        }, 2000);    
</script>

<script>





@stop
