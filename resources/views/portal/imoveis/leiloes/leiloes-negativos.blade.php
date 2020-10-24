@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

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
                Controle de Leilões Negativos
            </h1>
        </div>

        <!-- <div class="col-sm-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraDistrato">
                <i class="far fa-lg fa-edit"></i>
                Cadastrar Pedido de Distrato
            </button>
        </div> -->

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/estoque-imoveis/leiloes-negativos"> Preparar e Ofertar</a> </li>
                <li class="breadcrumb-item active">Controle de Leilões Negativos</li>
            </ol>
        </div>
    </div>

@stop


@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                    <li class="nav-item d-none d-sm-block">
                        <form class="form-inline m-0" id="formBarraBusca" action="/estoque-imoveis/consultar-imovel/resultado-LeilaoNegativo" method="post">
                            {{ csrf_field() }}
                            <select name="tipoVariavel" style="display: none;" id="tipoVariavel" class="form-control form-control-navbar mr-3 text-white" required>
                                <option class="text-dark"  value="numeroContrato">Contrato</option>
                            </select>
                            <div class="input-group nav-search-bar">
                                <input class="form-control form-control-navbar" type="text"  autocomplete="off" name="valorVariavel" placeholder="Pesquise por contrato" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"  title="Pesquisar"> <i class="fas fa-search"></i> </button>
                                </div>
                            </div>
                        </form>
                    </li>
                    {{-- <small class="form-text text-muted pl-2"><span style="color: red;"> * </span> sem formatação.</small> --}}
                        </div>
                        <div class="col-4 ml-5">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <a href="leiloes-negativos/baixar-planilha"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Download planilha completa de leilões"><i class="fas fa-file-download"></i>&nbsp Lista Leilões</button></a>
                        </div>
                    </div>
                    <br><br>

                    <div class="row">
                        <div class="col-sm-12 table-responsive p-0">
                            <table id="tblleiloesnegativos" class="table table-bordered table-striped hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Número do leilão</th>
                                        <th>Quantidade de contratos</th>
                                        <th>Data do segundo leilão</th>

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

    <!-- Modal -->
    <!-- <div class="modal fade" id="modalCadastraDistrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method='post' action='/estoque-imoveis/distrato/cadastrar-demanda' id="formCadastraDemandaDistrato">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Pedido de Distrato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>CHB Formatado:</label>
                            <input type="text" name="contratoFormatado" class="form-control" id="inputChb" placeholder="00.0000.0000000-0" required>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-primary" onclick="_validarCHB('#inputChb');">Validar CHB</button>
                        </div>

                        <div class="form-group">
                            <label>Nome do Proponente:</label>
                            <input type="text" name="nomeProponente" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>CPF / CNPJ:</label>
                            <input type="text" name="cpfCnpjProponente" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->


@stop

@section('footer')


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script src="{{ asset('js/global/formata-datable-dataVencimento.js') }}"></script>
    <script src="{{ asset('js/global/formata_data.js') }}"></script>
    <script src="{{ asset('js/global/formata-data-datable.js') }}"></script>
    <script src="{{ asset('js/portal/imoveis/leiloes/leiloes-negativos.js') }}"></script>
    

@stop