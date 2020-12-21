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
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Corretores
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">  <a href="/"> Principal</a> </li>
            <li class="breadcrumb-item active"> Corretores</a> </li>
            <li class="breadcrumb-item active"> Consulta</a> </li>
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

            <!--
            <div class="card-header">
                <h3 class="card-title">Listagem de corretores</h3>&nbsp&nbsp

            </div> 
            -->
                        <div id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="card card-primary">
                                <div class="card-header" role="tab" id="headingOne"  onclick="mudaColapse()">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="row">
                                            <p class="card-title" >Como atualizar o status de contrato dos Corretores?</p>
                                        </div>
                                    </a>
                                </div>

                                <div id="collapseOne" class="collapse no-show" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="card-body" style="background-color: #f4f6ff;">
                                        <div class="col-sm-12">
                                            <p class="text-justify mb-0">
                                                <b>1. </b>Para status "Pré-habilitado", é possível o envio de mensagem com orientação ao corretor ou solicitação à Área Gestora da Caixa para cadastramento no sistema SAP.<br>
                                                <b>2. </b>Há citação do nº do <b class="editalVigente" class="badge badge-info badge-large mx-4"></b>.<br>
                                                <b>3. </b>Este nº pode ser atualizado, caso necessário. --> <a data-toggle="modal" href="#cadastraEditalSP"><span style="color: green;"><b>Clique aqui para editar</b></a></span><br>
                                            </p>
                                        </div>     
                                    </div>
                                </div>
                            </div>
                        </div>
            
            <div class="card-body">
                <div class="notice notice-success">
                    <strong>Corretores: </strong>Listagem de corretores com contrato <strong>ATIVO</strong> registrado no SIMOV. &nbsp &nbsp
                    <a href="corretores/baixar-planilha"><button style="float: right" type="button" class="btn btn-success">Baixar a Planilha Corretores &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                </div><br>

                
                
                <div class="row">
                    <div class="col-sm-3">
                        <select id="selectGILIE" class="form-control">
                            <option value="" selected>Selecione a GILIE</option>
                            <option value="7244">GILIE/BH</option>
                            <option value="7242">GILIE/BU</option>
                            <option value="7243">GILIE/BE</option>
                            <option value="7109">GILIE/BR</option>
                            <option value="7247">GILIE/CT</option>
                            <option value="7248">GILIE/FO</option>
                            <option value="7249">GILIE/GO</option>
                            <option value="7251">GILIE/PO</option>
                            <option value="7254">GILIE/RJ</option>
                            <option value="7253">GILIE/RE</option>
                            <option value="7255">GILIE/SA</option>
                            <option value="7257">GILIE/SP</option>
                        </select>
                    </div>

                        <div class="col-sm-2"></div>
                    
                        <!--
                        <div class="col-sm-4">
                        <p><b class="editalVigente" class="badge badge-info badge-large mx-4"></b> </p>
                        </div>
                        -->

                </div>

                <div class="row"></div>
                    <div class="col-md-12" id="tblSP" style="display: none;">
                        <div class="spinner-border spinnerTbl text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>
                    
                        <!--
                            <div class:="botaoAlterar" style="float: right">
                            <br>
                            <span data-toggle="tooltip" data-placement="top" title="Alterar Edital">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cadastraEditalSP">
                             <i class="far fa-lg fa-edit"></i> Alterar nº Edital
                            </button>
                            <br>
                        </div>
                        

                        <div class:="botaoAlterar" style="float: left">
                            <br>
                            Clique <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cadastraEditalSP"><span data-toggle="tooltip" data-placement="top" title="Alterar Edital">
                             <i class="far fa-edit"></i></button> para alterar o nº do Edital de Licitação.
                            <br><br>
                        </div>

                        -->

                        <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalSP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Alterar nº Edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7257">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                       

                        <table id="tblCorretores" class="table table-bordered table-striped dataTable">
                            <br>
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12" id="tblSA" style="display: none;">
                        <div class="spinner-border spinnerTblSA text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>

                         <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalSA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7255">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresSA" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12" id="tblRE" style="display: none;">
                        <div class="spinner-border spinnerTblRE text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>

                         <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalRE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7253">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresRE" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12" id="tblRJ" style="display: none;">
                        <div class="spinner-border spinnerTblRJ text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>
 
                        <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalRJ" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7254">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresRJ" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12" id="tblPO" style="display: none;">
                        <div class="spinner-border spinnerTblPO text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>

 
                        <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalPO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7251">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresPO" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12" id="tblGO" style="display: none;">
                        <div class="spinner-border spinnerTblGO text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>

                        <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalGO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7249">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresGO" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row"></div>
                    <div class="col-md-12" id="tblFO" style="display: none;">
                        <div class="spinner-border spinnerTblFO text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>

                        <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalFO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7248">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresFO" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row"></div>
                    <div class="col-md-12" id="tblCT" style="display: none;">
                        <div class="spinner-border spinnerTblCT text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>

                        <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalCT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7247">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresCT" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row"></div>
                    <div class="col-md-12" id="tblBR" style="display: none;">
                        <div class="spinner-border spinnerTblBR text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>

                        <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalBR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7109">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresBR" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row"></div>
                    <div class="col-md-12" id="tblBE" style="display: none;">
                        <div class="spinner-border spinnerTblBE text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>

                        <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalBE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7243">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresBE" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row"></div>
                    <div class="col-md-12" id="tblBU" style="display: none;">
                        <div class="spinner-border spinnerTblBU text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>

                        <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalBU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7242">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresBU" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row"></div>
                    <div class="col-md-12" id="tblBH" style="display: none;">
                        <div class="spinner-border spinnerTblBH text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <br>

                        <div class="cadastraEdital">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="cadastraEditalBH" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastra edital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="corretores/cadastra-edital" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nº Edital</label>
                                              <input type="text" class="form-control" aria-describedby="cadastra Edital" placeholder="9999/9999-9999" minlength="14" maxlength="14" name="numeroEdital" required>
                                            </div>
                                            <input type="hidden" name="gilie" value="7244">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Alterar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <table id="tblCorretoresBH" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo Contrato</th>
                                    <th> </th>
                                    <th>Vencimento Contrato</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>



                </div>

            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->


</div> <!-- /.row -->
</div>

@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
<script src="{{ asset('js\global\formata-data-datable.js') }}"></script>
<script src="{{ asset('js/portal/corretores/corretores.js') }}"></script>

<script>
    setTimeout(function(){
        $('.bg-danger').fadeOut("slow");
        $('.bg-success').fadeOut("slow");
        }, 2000);    
</script>

<script>
function mudaColapse() {
    if($('#collapse').text() == "X" ){
    $('#collapse').text("Expandir")
    }else{
        $('#collapse').text("X")
    }
}
</script>



@stop
