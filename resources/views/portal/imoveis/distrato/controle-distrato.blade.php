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
  Abrir modal de demonstração
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
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Motivo de Distrato:</label>
                        <select class="form-control">
                            <option>AÇÃO JUDICIAL</option>
                            <option>AÇÃO JUDICIAL</option>
                            <option>AÇÃO JUDICIAL</option>
                            <option>AÇÃO JUDICIAL</option>
                            <option>AÇÃO JUDICIAL</option>
                            <option>AÇÃO JUDICIAL</option>
                            <option>AÇÃO JUDICIAL</option>
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


@stop

@section('footer')


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')

<script src="{{ asset('js/portal/distrato/distrato.js') }}"></script>

@stop