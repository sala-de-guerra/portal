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
                            <p id="chb">00.0000.0001766-3</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Classificação:</label>
                            <p id="classificacao">PANAMERICANO</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Tipo de Venda:</label>
                            <p id="tipoVenda">VENDA DIRETA ONLINE</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Empreendimento:</label>
                            <p id="empreendimento">BALN REGINA MARIA</p>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Endereço:</label>
                            <p id="endereco">RUA AUGUSTA, N. 183, Apto 202, TORRE 2B</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Bairro:</label>
                            <p id="bairro"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Localidade:</label>
                            <p id="localidade">GUARULHOS/SP </p>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Status do imóvel:</label>
                            <p id="statusImovel">Em Contratação</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Data do Status:</label>
                            <p id="dataStatus">Em Contratação</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Número do Laudo:</label>
                            <p id="numeroLaudo">12356546</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Vencimento do Laudo:</label>
                            <p id="vencimentoLaudo">12356546</p>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Descrição Adicional:</label>
                            <p id="descricaoAdicional">(E) sem débitos condominiais até 12/2018 conforme CND enviada no dossiê </p>
                        </div>
                    </div>
                </div>
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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> <!-- Collapse Button -->
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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> <!-- Collapse Button -->
                </div> <!-- /.card-tools -->
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">
                        <table id="tblLaudos" class="table">
                            <thead>
                            <tr>
                                <th>Visualizar Documento</th>
                                <th>Nome do Documento</th>
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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> <!-- Collapse Button -->
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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> <!-- Collapse Button -->
                </div> <!-- /.card-tools -->
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CHB:</label>
                            <p id="chb">00.0000.0001766-3</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Classificação:</label>
                            <p id="classificacao">PANAMERICANO</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Tipo de Venda:</label>
                            <p id="tipoVenda">VENDA DIRETA ONLINE</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Empreendimento:</label>
                            <p id="empreendimento">BALN REGINA MARIA</p>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Endereço:</label>
                            <p id="endereco">RUA AUGUSTA, N. 183, Apto 202, TORRE 2B</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Bairro:</label>
                            <p id="bairro"></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Localidade:</label>
                            <p id="localidade">GUARULHOS/SP </p>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Status do imóvel:</label>
                            <p id="statusImovel">Em Contratação</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Data do Status:</label>
                            <p id="dataStatus">Em Contratação</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Número do Laudo:</label>
                            <p id="numeroLaudo">12356546</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Vencimento do Laudo:</label>
                            <p id="vencimentoLaudo">12356546</p>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Descrição Adicional:</label>
                            <p id="descricaoAdicional">(E) sem débitos condominiais até 12/2018 conforme CND enviada no dossiê </p>
                        </div>
                    </div>
                </div>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->
    

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Callouts
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="callout callout-danger">
                <h5>I am a danger callout!</h5>

                <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                    soul,
                    like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="callout callout-info">
                <h5>I am an info callout!</h5>

                <p>Follow the steps to continue to payment.</p>
                </div>
                <div class="callout callout-warning">
                <h5>I am a warning callout!</h5>

                <p>This is a yellow callout.</p>
                </div>
                <div class="callout callout-success">
                <h5>I am a success callout!</h5>

                <p>This is a green callout.</p>
                </div>
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div> <!-- /.row -->


<div class="row">
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Callouts
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="callout callout-danger">
                <h5>I am a danger callout!</h5>

                <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire
                    soul,
                    like these sweet mornings of spring which I enjoy with my whole heart.</p>
                </div>
                <div class="callout callout-info">
                <h5>I am an info callout!</h5>

                <p>Follow the steps to continue to payment.</p>
                </div>
                <div class="callout callout-warning">
                <h5>I am a warning callout!</h5>

                <p>This is a yellow callout.</p>
                </div>
                <div class="callout callout-success">
                <h5>I am a success callout!</h5>

                <p>This is a green callout.</p>
                </div>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row -->

@section('footer')

<b>Copyright © 2009 - 2019 - GILIE/SP - Gerência de Alienação de Bens Móveis e Imóveis</b>

@stop

@stop

@section('css')

@stop


@section('js')
    <script src="{{ asset('js/global/anima_input_file.js') }}"></script>
    <script src="{{ asset('js/formata_tabela_documentos.js') }}"></script>
    <script src="{{ asset('js/formata_tabela_laudos.js') }}"></script>

    <script>
        var tamanhoMaximoView = 8;
        var tamanhoMaximo = 8388608;
        _animaInputFile();
        _formataTabelaDocumentos ();
        _formataTabelaLaudos ();
    </script>
@stop