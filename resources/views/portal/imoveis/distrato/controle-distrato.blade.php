@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">
            Distrato
        </h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> <i class="fa fa-map-signs"></i> <a href="/distrato"> Distrato</a> </li>
        </ol>
    </div>
</div>


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
                    <div id="tblDistrato" class="col-sm-12 table-responsive p-0">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th>CHB</th>
                                <th>Nome do Comprador</th>
                                <th>Status</th>
                                <th>Motivo</th>
                                <th>Data de Início</th>
                                <th>Vencimento</th>
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

<!-- Botão para acionar modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraDistrato">
    Cadastrar Pedido de Distrato
</button>

<!-- Modal -->
<div class="modal fade" id="modalCadastraDistrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Pedido de Distrato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>CHB:</label>
                        <input type="text" name="contratoFormatado" class="form-control" id="inputChb" required>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="_validarCHB('#inputChb');">Validar CHB</button>

                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" name="nomeProponente" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>CPF / CNPJ:</label>
                        <input type="text" name="cpfCnpjProponente" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Motivo de Distrato:</label>
                        <select name="motivoDistrato" class="form-control" required>
                            <option value="" selected>Selecione</option>
                            <option value="acaoJudicial">AÇÃO JUDICIAL</option>
                            <option value="leiloesNegativos">LEILÕES NEGATIVOS</option>
                            <option value="impossibilidadeAverbacaoAquisicao">IMPOSSIBILIDADE DE REGISTRO DE AQUISIÇÃO</option>
                            <option value="desistencia">DESISTÊNCIA</option>
                            <option value="creditoNaoAprovado">CRÉDITO NÃO APROVADO</option>
                            <option value="erroFormalEdital">ERRO FORMAL DE EDITAL</option>
                            <option value="direitoPreferencia">DIREITO DE PREFERÊNCIA DO EX-MUTUÁRIO</option>
                            <option value="distratoCancelado">DISTRATO CANCELADO</option>
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

@stop