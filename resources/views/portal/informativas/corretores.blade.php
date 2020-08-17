@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


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
        </ol>
    </div>
</div>


@stop


@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">Listagem de corretores</h3>&nbsp&nbsp

            </div> <!-- /.card-header -->
            
            <div class="card-body">
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
                </div><br>
                <div class="notice notice-success">
                    <strong>Corretores: </strong>Listagem de corretores com contrato <strong>ATIVO</strong> registrado no SIMOV. &nbsp &nbsp
                <a href="corretores/baixar-planilha"><button style="float: right" type="button" class="btn btn-success">Baixar a Planilha Corretores &nbsp &nbsp<i class="fas fa-file-excel"></i></button></a>
                </div><br>

                <div class="row"></div>
                    <div class="col-md-12" id="tblSP" style="display: none;">
                        <div class="spinner-border spinnerTbl text-primary" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <table id="tblCorretores" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresSA" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresRE" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresRJ" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresPO" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresGO" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresFO" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresCT" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresBR" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresBE" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresBU" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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
                        <table id="tblCorretoresBH" class="table table-bordered table-striped dataTable">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Creci</th>
                                    <th>Celular</th>
                                    <th>Email</th>
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


@stop

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

<script src="{{ asset('js/portal/informativas/corretores.js') }}"></script>


@stop
