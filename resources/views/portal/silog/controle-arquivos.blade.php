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
    <div class="card text-white bg-{{ session('corMensagem') }}">
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
                Controle de Envio de Caixa EMGEA
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/controle-arquivos"> Controle de Envio de Caixa EMGEA</a> </li>
            </ol>
        </div>
    </div>

@stop


@section('content')

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
                    <button id="collapse" class="btn btn-primary" style="float: right">X</button>
                </div>
            </div>
          </a>
        </h5>
      </div>

      <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" >
                                    <div class="card-header">
                                    
                                    </div> <!-- /.card-header -->
                                    <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12 table-responsive p-0">
                            <table id="tblimportexcel" class="table table-bordered table-striped hover dataTable">
                                <thead>
                                    <tr>
                                        <th style='width: 10%;'>Contrato</th>
                                        <th style='width: 5%;'>Caixa</th>
                                        <th style='width: 5%;'>Silog</th>
                                        <th style='width: 5%;'>Responsável</th>
                                        <th style='width: 5%;'>GILIE</th>
                                        <th style='width: 5%;'>Data Upload</th>

                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                                
                            </table><br><br>

                            <a href="/controle-arquivos/baixar"><button style="float: right" type="button" class="btn btn-success">Baixar a Planilha Completa &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a><br><br><br>
                                </div>
                            </div>
                        </div> <!-- /.col-sm-12 -->
                    </div> <!-- /.row -->
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
<script>$('.table').css({'overflow-x': 'hidden','border': 'none'});</script>
    <script src="{{ asset('js/global/formata_data.js') }}"></script>
    <script src="{{ asset('js/portal/silog/lista-upload.js') }}"></script>
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
    

@stop
