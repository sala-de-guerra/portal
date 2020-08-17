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
                Carga em Lote Averbacão Leilão Negativo
            </h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> <a href="/carga-em-lote/averbacao-leilao-negativo"> Carga em Lote</a> </li>
                     <li class="breadcrumb-item active"> Carga Leilão Negativo</li>
            </ol>
        </div>
    </div>

@stop


@section('content')

<div id="accordion" role="tablist" aria-multiselectable="true">
    <div class="card card-primary">
      <div class="card-header" role="tab" id="headingOne" >
        <h5 class="mb-0">
          <a aria-expanded="true">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title mt-2" >Como fazer a carga em lote ?</h3>
                </div>
            </div>
          </a>
        </h5>
      </div>

      <div id="collapseOne" class="" role="tabpanel" aria-labelledby="headingOne">
        <div class="card-block">
        
    <div class="row">
        <div class="col-md-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-justify"><b>1º -</b> Faça o Download do Modelo clicando no link ao lado-> <a href="/download/AverbacaoEmLote.xlsx"><span style="color: green;"><b>Clique aqui para baixar</b></a></span><br>
                                    <b>2º - </b> Preencha os contratos que serão averbados na primeira coluna<br>
                                    <b>3º - </b>Após preenchimento, salve o arquivo. <br>
                                    <b>4º - </b>Clique em <b>"Escolher o arquivo"</b> procure onde está salva a Planilha<br>
                                    <b>5º - </b>Espere aparecer a mensagem: <span style="color: green"><b>"Arquivo carregado com sucesso"</b></span><br>
                                    <b>6º - </b>Clique em <span style="color: green"><b>Enviar</b></span><br>
                                </div>
                            </div>
                        </div>
                                <form method="POST" action="/carga-em-lote/averbacao-leilao-negativo/envia" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
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
</script>
    

@stop
