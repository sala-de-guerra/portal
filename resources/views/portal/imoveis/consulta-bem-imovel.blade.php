@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Consultar Bem Imóvel
        </h1>
        <!-- <div>
            <input class="typeahead" type="text" placeholder="States of USA">
        </div> -->
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> <a href="/index"> Imóveis Caixa</a> </li>
            <li class="breadcrumb-item active"> <a href="/index"> Consultar Bem Imóvel</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Trajetória do Imóvel</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div> <!--/.progress          -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Dados do Imóvel</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CHB:</label>
                            <p id="numeroBemFormatado"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Classificação:</label>
                            <p id="classificacao"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Tipo de Venda:</label>
                            <p id="tipoVenda"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Empreendimento:</label>
                            <p id="nomeEmpreendimento"></p>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Endereço:</label>
                            <p id="enderecoImovel"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Bairro:</label>
                            <p id="bairroImovel"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CEP:</label>
                            <p id="cep"></p>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>UF do Imóvel:</label>
                            <p id="ufImovel"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Cidade do Imóvel:</label>
                            <p id="cidadeImovel"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Tipo de Imóvel:</label>
                            <p id="tipoImovel"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Estado do Imóvel:</label>
                            <p id="estadoImovel"></p>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Descrição do Imóvel:</label>
                            <p id="descricaoImovel"></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Descrição Adicional:</label>
                            <p id="descricaoAdicionalImovel"></p>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card collapsed-card card-primary">
            <div class="card-header">
                <h3 class="card-title">Dossiê Digital</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                </div> <!-- /.card-tools -->
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">
                        <table id="tblDossieDigital" class="table">
                            <thead>
                            <tr>
                                <th>Visualizar Documento</th>
                                <th>ID do Documento</th>
                                <th>Nome do Documento</th>
                                <th>Tipo de Documento</th>
                                <th>Data do Upload</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div> <!-- /.col-sm-12 -->
                </div> <!-- /.row -->

                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUploadArquivo">
                            <i class="fas fa-cloud-upload-alt"></i>
                                Upload de Arquivo
                        </button>
                        <div class="modal fade" id="modalUploadArquivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload de Arquivo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="" enctype="multipart/form-data" id="formCarregaArquivo">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Tipo de Documento</label>
                                                    <select class="form-control select2" style="width: 100%;" required>
                                                        <option selected="selected">Documento 1</option>
                                                        <option>Documento 2</option>
                                                        <option>Documento 3</option>
                                                        <option>Documento 4</option>
                                                        <option>Outros</option>
                                                    </select>
                                                </div> <!-- /.form-group col-md-12 -->
                                            </div> <!-- /.row -->
                                            <div class="row">
                                                <div class="col-md-12 input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-primary front">
                                                            <i class="fa fa-lg fa-cloud-upload"></i>
                                                                Carregar arquivo&hellip;
                                                        </span>
                                                        <input type="file" class="behind" accept=".pdf" name="uploadArquivo[]" id="inputUploadArquivo" required>
                                                    </label>
                                                    <input type="text" class="form-control previewNomeArquivo" readonly>
                                                </div><!-- /.col input-group -->
                                            </div> <!-- /.row -->
                                            <div class="row">
                                                <div class="input-group col-md-2">
                                                    <button type="submit" id="submitBtn" class="btn btn-primary">Gravar</button>
                                                </div> <!-- /.col input-group -->
                                            </div> <!-- /.row -->
                                        </form>
                                    </div><!-- /.modal-body -->
                                </div>
                            </div>
                        </div> <!-- /.modal -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card collapsed-card card-primary">
            <div class="card-header">
                <h3 class="card-title">Laudos de Avaliação</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                </div> <!-- /.card-tools -->
            </div> <!-- /.card-header -->
            <div class="card-body">
            
                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">
                        <table id="tblLaudos" class="table">
                            <thead>
                            <tr>
                                <th>Visualizar Documento</th>
                                <th>Número do Laudo</th>
                                <th>Data do Laudo</th>
                                <th>Vencimento do Laudo </th>
                                <th>Data do Upload</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div> <!-- /.col-sm-12 -->
                </div> <!-- /.row -->

                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUploadLaudo">
                            <i class="fas fa-cloud-upload-alt"></i>
                             Upload de Arquivo
                        </button>
                        <div class="modal fade" id="modalUploadLaudo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload de Laudo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="" enctype="multipart/form-data" id="formCarregaLaudo">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Data do Laudo</label>
                                                    <input type="text" class="form-control" placeholder="DD/MM/AAAA" required>
                                                </div> <!-- /.form-group col-md-12 -->
                                            </div> <!-- /.row -->
                                            <div class="row">
                                                <div class="col-md-12 input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-primary front">
                                                            <i class="fa fa-lg fa-cloud-upload"></i>
                                                             Carregar arquivo&hellip;
                                                        </span>
                                                        <input type="file" class="behind" accept=".pdf" name="uploadLaudo[]" id="inputUploadLaudo" required>
                                                    </label>
                                                    <input type="text" class="form-control previewNomeArquivo" readonly>
                                                </div><!-- /.col input-group -->
                                            </div> <!-- /.row -->
                                            <div class="row">
                                                <div class="input-group col-md-2">
                                                    <button type="submit" id="submitBtn" class="btn btn-primary">Gravar</button>
                                                </div> <!-- /.col input-group -->
                                            </div> <!-- /.row -->
                                        </form>
                                    </div><!-- /.modal-body -->
                                </div>
                            </div>
                        </div> <!-- /.modal -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->


<div class="row">
    <div class="col-md-12">
        <div class="card collapsed-card card-primary">
            <div class="card-header">
                <h3 class="card-title">Gestão de Chaves</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                </div> <!-- /.card-tools -->
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">
                        <table id="tblChaves" class="table">
                            <thead>
                            <tr>
                                <th>ID Chaves</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div> <!-- /.col-sm-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card collapsed-card card-primary">
            <div class="card-header">
                <h3 class="card-title">Etapa de Leilão</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                </div> <!-- /.card-tools -->
            </div> <!-- /.card-header -->
            <div class="card-body">
                
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card collapsed-card card-primary">
            <div class="card-header">
                <h3 class="card-title">Etapa de Venda Direta</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button> <!-- Collapse Button -->
                </div> <!-- /.card-tools -->
            </div> <!-- /.card-header -->
            <div class="card-body">

                <h2 class="card-title"><b>Proponente Atual</b></h2>

                <br>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nome:</label>
                            <p id="nomeProponente"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CPF / CNPJ:</label>
                            <p id="cpfCnpjProponente"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Telefone:</label>
                            <p id="telefoneProponente"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>E-mail:</label>
                            <p id="emailProponente"></p>
                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nome do Corretor:</label>
                            <p id="nomeCorretor"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CRECI do Corretor:</label>
                            <p id="numeroCreciCorretor"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Telefone do Corretor:</label>
                            <p id="telefoneCorretor"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>E-mail do Corretor:</label>
                            <p id="emailCorretor"></p>
                        </div>
                    </div>
                </div><!-- /.row -->

            <hr>

                <h2 class="card-title"><b>Proposta Atual</b></h2>

            <br>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Data da Proposta:</label>
                            <p id="dataProposta"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Total da Proposta:</label>
                            <p id="valorTotalProposta"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Valor em Recursos Próprios:</label>
                            <p id="valorRecursosPropriosProposta"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Valor de FGTS:</label>
                            <p id="valorFgtsProposta"></p>
                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Valor de Financiamento:</label>
                            <p id="valorFinanciamentoProposta"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Valor Parcelado:</label>
                            <p id="valorParceladoProposta"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Número de Parcelas:</label>
                            <p id="numeroParcelasProposta"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Total Recebido:</label>
                            <p id="valorTotalRecebidoProposta"></p>
                        </div>
                    </div>
                </div><!-- /.row -->

                <hr>

                <h2 class="card-title"><b>Agência Responsável</b></h2>

                <br>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Código:</label>
                            <p id="codigoAgenciaResponsavelProposta"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Unidade:</label>
                            <p id="nomeAgenciaResponsavelProposta"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Caixa Postal:</label>
                            <p id="caixaPostalAgenciaResponsavelProposta"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Contato:</label>
                            <p id="contatoAgenciaResponsavelProposta"></p>
                        </div>
                    </div>
                </div><!-- /.row -->

                <hr>

                <h2 class="card-title"><b>CIOPE</b></h2>

                <br>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Tipo de Contratacao:</label>
                            <p id="tipoContratacaoCiope"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Card Agrupamento:</label>
                            <p id="cardAgrupamentoCiope"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Status Dossiê:</label>
                            <p id="statusDossieCiope"></p>
                        </div>
                    </div>
                </div><!-- /.row -->


            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Histórico</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div id="tblHistorico" class="col-sm-12 table-responsive p-0">
                        <!-- <table class="table">
                            <thead>
                            <tr>
                                <th>ID Historico</th>
                                <th>Data/Hora</th>
                                <th>Responsável</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table> -->
                    </div> <!-- /.col-sm-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Mensagens Enviadas</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div id="tblHistorico" class="col-sm-12 table-responsive p-0">
                        <!-- <table class="table">
                            <thead>
                            <tr>
                                <th>ID Historico</th>
                                <th>Data/Hora</th>
                                <th>Responsável</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table> -->
                    </div> <!-- /.col-sm-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->


@section('footer')


@stop

@stop

@section('css')

@stop


@section('js')
    <script src="{{ asset('js/global/anima_input_file.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_documentos.js') }}"></script>
    <script src="{{ asset('js/global/formata_tabela_laudos.js') }}"></script>

    <script>


        $.getJSON('js/imovel_mockado.json', function(dados){
            console.log(dados[0]);

            var numeroBem = dados[0].numeroBem;
            _formataTabelaDocumentos (numeroBem);

            $.each(dados[0].dossieDigital, function(numeroBem) {
                _formataTabelaLaudos (numeroBem);
            });


            $.each(dados[0], function(key, item) {
                $('#' + key).html(item);
            });


        });


        var tamanhoMaximoView = 8;
        var tamanhoMaximo = 8388608;

        _animaInputFile();


    </script>
@stop