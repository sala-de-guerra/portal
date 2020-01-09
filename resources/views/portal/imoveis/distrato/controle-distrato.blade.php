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
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Controle de Distrato
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/distrato"> Controle de Distrato</a> </li>
        </ol>
    </div>
</div>

<!-- Botão para acionar modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraDistrato">
    <i class="far fa-lg fa-edit"></i>
     Cadastrar Pedido de Distrato
</button>


@stop


@section('content')


<div class="row">
<div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Distratos em Andamento</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">
                        <table id="tblDistrato" class="table table-bordered table-striped hover dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CHB</th>
                                    <th>Nome do Comprador</th>
                                    <th>Status</th>
                                    <th>Motivo</th>
                                    <th>Data de Início</th>
                                    <!-- <th>Vencimento</th> -->
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

<br>

<!-- Modal -->
<div class="modal fade" id="modalCadastraDistrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" name="nomeProponente" class="form-control" readonly required>
                    </div>

                    <div class="form-group">
                        <label>CPF / CNPJ:</label>
                        <input type="text" name="cpfCnpjProponente" class="form-control" readonly required>
                    </div>

                    <div class="form-group">
                        <label>Motivo de Distrato:</label>
                        <select name="motivoDistrato" class="form-control" required>
                            <option value="" selected>Selecione</option>
                            <option value="AÇÃO JUDICIAL">AÇÃO JUDICIAL</option>
                            <option value="LEILÕES NEGATIVOS">LEILÕES NEGATIVOS</option>
                            <option value="IMPOSSIBILIDADE DE REGISTRO DE AQUISIÇÃO">IMPOSSIBILIDADE DE REGISTRO DE AQUISIÇÃO</option>
                            <option value="DESISTÊNCIA">DESISTÊNCIA</option>
                            <option value="CRÉDITO NÃO APROVADO">CRÉDITO NÃO APROVADO</option>
                            <option value="ERRO FORMAL DE EDITAL">ERRO FORMAL DE EDITAL</option>
                            <option value="DIREITO DE PREFERÊNCIA DO EX-MUTUÁRIO">DIREITO DE PREFERÊNCIA DO EX-MUTUÁRIO</option>
                            <option value="DISTRATO CANCELADO">DISTRATO CANCELADO</option>
                        </select>
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

<br>

@stop

@section('footer')


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

<script src="{{ asset('js/portal/distrato/controle-distrato.js') }}"></script>
<script src="{{ asset('js/global/formata_datatable.js') }}"></script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>



@stop