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
            Controle de Chaves
        </h1>
    </div><br>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrarChaveModal">
    Cadastrar Chave
  </button>
  
  <div class="modal fade" id="cadastrarChaveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method='post' action='/estoque-imoveis/cadastra-chave' id="formCadastraDemandaDistrato">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Chave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>CHB Formatado:</label>
                        <input type="text" name="contratoFormatado" class="form-control" id="inputChb" placeholder="00.0000.0000000-0" required>
                        <input type="hidden" name="contratoSemFormatacao" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-primary" onclick="_validarCHB('#inputChb');">Validar CHB</button>
                    </div>

                    <div class="form-group">
                        <label>Endereço Imóvel:</label>
                        <input type="text" name="enderecoImovel" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nº Chave:</label>
                        <input type="number" min="1" name="numeroChave" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Quantidade Chaves:</label>
                        <input type="number" min="1" max="6" name="quantidadeChave" class="form-control" required>
                        <small class="form-text text-muted">*limite de 6 chaves.</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/estoque-imoveis/conformidade-contratacao">Contratação</a> </li>
            <li class="breadcrumb-item active"><a href="/estoque-imoveis/chaves"> Controle de Chaves</a> </li>    
        </ol>
    </div>
</div><br>

@stop 


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" id="custon-tabs-li-tmaAvista">
                        <a class="nav-link active" id="custom-tabs-one-tmaAvista-tab" data-toggle="pill" href="#custom-tabs-one-tmaAvista" role="tab" aria-controls="custom-tabs-one-tmaAvista" aria-selected="true">
                            <h5>Geral</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-tmaFinanciado">
                        <a class="nav-link" id="custom-tabs-one-tmaFinanciado-tab" data-toggle="pill" href="#custom-tabs-one-tmaFinanciado" role="tab" aria-controls="custom-tabs-one-tmaFinanciado" aria-selected="false">
                            <h5>Emprestado</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="">
                        <a style="display: none;" class="nav-link" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="">
                        <a class="nav-link" style="display: none;" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>
                    
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show active" id="custom-tabs-one-tmaAvista" role="tabpanel" aria-labelledby="custom-tabs-one-tmaAvista-tab">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="notice notice-success">
                                    <strong>Geral: </strong> Lista geral de controle de chaves
                                </div><br>
                                <div id="displayAberto">
                                    <table id="tblControleChaveGeral" class="table table-bordered table-striped dataTable">
                                        <div class="spinner-border spinnerTblGeral text-primary" role="status">
                                            <span class="sr-only"></span>
                                          </div>
                                          <span class="spinnerTblGeral">Carregando Tabela Aguarde...</span>
                    
                                        <thead>
                                            <tr>
                                                <th>Contrato</th>
                                                <th>Nº Chave</th>
                                                <th>Quantidade</th>
                                                <th>Emprestadas</th>
                                                <th>Endereço</th>
                                                <th>Ocupação</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                    
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
          

        <div class="tab-pane fade" id="custom-tabs-one-tmaFinanciado" role="tabpanel" aria-labelledby="custom-tabs-one-tmaFinanciado-tab">
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="notice notice-danger"> 
                                        <strong>Emprestado: </strong> Lista de chaves emprestadas
                                    </div><br>

                                      <table id="tblControleChavesEmprestadas" class="table table-bordered table-striped dataTable">
                                        <div class="spinner-border spinnerTbl text-primary" role="status">
                                            <span class="sr-only"></span>
                                          </div>
                                          <span class="spinnerTbl">Carregando Tabela Aguarde...</span>
                    
                                        <thead>
                                            <tr>
                                                <th>Contrato</th>
                                                <th>Chave</th>
                                                <th>Endereço</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                    
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
 
@stop


@section('js')
<script src="{{ asset('js/portal/imoveis/controle/controle-de-chaves.js') }}"></script>
<script>
    function _validarCHB(inputChb){
    $("input[name='enderecoImovel']").val('');
    $("input[name='contratoSemFormatacao']").val('');

    let numeroContrato = $(inputChb).val()
    
    $.getJSON('/estoque-imoveis/consulta-contrato/' + numeroContrato, function(dados){
        $("input[name='enderecoImovel']").val(dados.enderecoImovel);
        $("input[name='contratoSemFormatacao']").val(dados.numeroBem);
    })
    .fail(function() {
        alert("CHB " + numeroContrato + " não encontrado!");
    });
};
</script>
@stop
