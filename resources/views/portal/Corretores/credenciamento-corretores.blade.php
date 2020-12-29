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

<div class="row">
    <div class="col-lg">
        <h4 class="m-0 text-dark">
        Controle de Credenciamento dos Corretores feito em colaboração entre as áreas GILIE/SP e CECAT/SP.
        </h4>
    </div>

    <div class="col-sm-3">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">  <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Corretores</a> </li>
            <li class="breadcrumb-item active"> Credenciamento</a> </li>
        </ol>
    </div>
</div>

                <div class="col-sm-12" style="text-align: right;" >
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrarCredenciado">
                        <i class="far fa-lg fa-edit"></i>
                        Cadastrar Novo Corretor Credenciado
                    </button>
                </div><br>

@stop


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div id="accordion" role="tablist" aria-multiselectable="true">
                <div class="card card-primary">
                    <div class="card-header" role="tab" id="headingOne"  onclick="mudaColapse()">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title mt-2" >Como fazer a atualização geral dos dados ?</h3>
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
                                                        <p class="text-justify"><b>1º -</b> Faça o Download da planilha com a Lista Geral de Credenciamento-> <a href="/corretores/baixar-planilha-credenciamento.xlsx"><span style="color: green;"><b>Clique aqui para baixar</b></a></span><br>
                                                        <b>2º - </b>Preencha os dados. <br>
                                                        <b>3º - </b>Após preenchimento, salve o arquivo. <br>
                                                        <b>4º - </b>Clique em <b>"Escolher o arquivo"</b> procure onde está salva a Planilha<br>
                                                        <b>5º - </b>Espere aparecer a mensagem: <span style="color: green"><b>"Arquivo carregado com sucesso"</b></span><br>
                                                        <b>6º - </b>Clique em <span style="color: green"><b>Enviar</b></span><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <form method="POST" action="/corretores/upload-planilha-credenciamento" enctype="multipart/form-data">
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
                </div>
            

            <div class="card-body">
                <div class="notice notice-success">
                Lista geral de credenciamento dos corretores. &nbsp &nbsp
                    <a href="/corretores/baixar-planilha-credenciamento"><button style="float: right" type="button" class="btn btn-success">Baixar Lista Geral &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                <br>
                </div><br>
                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">
                        <table id="tblCredenciamento" class="table table-bordered table-striped hover dataTable">
                            <thead>
                                <tr>
                                    <th>Processo</th>
                                    <th style="text-align:center;">Nome Credenciado</th>
                                    <th>Nº Contrato</th> <!--nº do contrato - preenchido Gilog-->
                                    <th style="text-align:center;">Convocação</th> <!--data convocação - preenchido Gilog-->
                                    <th>Contrato Disponível</th> <!--SIM/NÃO - preenchido Gilog-->
                                    <th style="text-align:center;">SICAF</th> <!--pendente/regular - preenchido Gilog-->
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                            
                        </table><br>

                        </div>
                    </div>
                </div> <!-- /.col-sm-12 -->
            </div>
            </div> <!-- /.row -->
        </div> <!-- /.card-body -->
    </div> <!-- /.card -->
</div> <!-- /.col -->
</div> <!-- /.row -->


<!-- Modal -->
<div class="modal fade" id="modalCadastrarCredenciado" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method='post' action='/corretores/adiciona-corretor-credenciado' id="formCadastraCredenciado">
            {{ csrf_field() }} 
                <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                    <h5 style="color: white;" class="modal-title" id="exampleModalScrollableTitle">Cadastro de novo Corretor Credenciado para análise da CECAT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-0">
                    
                        <div class="px-2" style="overflow-y: auto; height: 100%;">
                            <div class="form-group">
                                <label>Nome do Credenciado</label>
                                <input type="text" name="nomeCredenciado" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="form-group" required>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pfpj" id="pj" value="pj" onclick="mostraPj()">
                                    <label class="form-check-label" for="pj">
                                        Pessoa Jurídica
                                    </label>
                                        <div class="form-group" style="display: none;" id="mostrarPj">
                                            <label>CNPJ</label>
                                            <input type="text" name="CNPJ" class="form-control" id="dadoCNPJ" autocomplete="off" placeholder="00.000.000/0000-00" required><br>
                                        
                                        <p><b>e/ou</b></p>
                                        
                                            <label>CPF</label>
                                            <input type="text" name="CPF" class="form-control" autocomplete="off" placeholder="000.000.000-00">
                                        </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pfpj" id="pf" value="pf" onclick="mostraPf()">
                                    <label class="form-check-label" for="pf">
                                        Pessoa Física
                                    </label>
                                    <div class="form-group" style="display: none;" id="mostrarPf">
                                            <label>CPF</label>
                                            <input type="text" name="CPF" class="form-control" id="dadoCPF"  autocomplete="off" placeholder="000.000.000-00" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nome do Representante</label>
                                <input type="text" name="nomeRepresentante" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <label>E-mail credenciado</label>
                                <input type="email" name="email" class="form-control" placeholder="exemplo@email.com.br" autocomplete="off" required>
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
function mostraPj(){
    $("#mostrarPf").css("display", "none");
    $("#mostrarPj").css("display", "block");
    $("#dadoCPF").removeAttr("required");
    $("#dadoCNPJ").prop('required',true);
}
function mostraPf(){
    $("#mostrarPj").css("display", "none");
    $("#mostrarPf").css("display", "block");
    $("#dadoCNPJ").removeAttr("required");
    $("#dadoCPF").prop('required',true);
}
</script>

<script>
$("[name='CNPJ']").mask("00.000.000/0000-00");
$("[name='CPF']").mask("000.000.000-00");
</script>

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