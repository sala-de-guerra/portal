@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col">
        <h1 class="m-0 text-dark">
            Gestão de Atividades
        </h1>
    </div>

     <div class="col-sm-3">
        <select name="selectEquipe" id="selectEquipe" class="form-control">
            <option value="" selected disabled>Selecione</option>
        </select>
    </div>

    <div id="buttons">

        <button type="button" class="btn btn-success p-1 m-1" data-toggle="modal" data-target="#modalCriarAtividade">
            <i class="fas fa-plus mx-2"></i>Criar Atividade
        </button>

        <div class="modal fade" id="modalCriarAtividade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Criar Atividade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="" id="" value="checkedValue" required> Display value
                                    <input class="form-check-input" type="radio" name="" id="" value="checkedValue"> Display value
                                </label>
                            </div>

                            <form method="post" action="/url" id="formCriarAtividade">

                                <input type="hidden" name="codigoUnidadeEquipe" class="form-control" id="unidade" value="{{ session()->get('codigoLotacaoAdministrativa') }}">

                                <div class="form-group">
                                    <label>Nome da Atividade:</label>
                                    <input type="text" name="nomeAtividade" class="form-control" id="nomeAtividadeCriar" required>
                                </div>

                                <div class="form-group">
                                    <label>Gestor da Célula:</label>
                                    <select name="matriculaGestor" id="selectCriarEquipe" class="form-control" required></select>
                                </div>

                                <!-- <input type="hidden" name="nomeGestor" id="nomeGestorCriar"> -->

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                </div>
            </div>
        </div>

        &nbsp

        <button type="button" class="btn btn-primary p-1 m-1" data-toggle="modal" data-target="#modalAlterarAtividade">
            <i class="far fa-edit mx-2"></i>Alterar Atividade
        </button>

        <div class="modal fade" id="modalAlterarAtividade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="/url" id="formAlterarAtividade" onsubmit="noRefreshPost(this);return false">
                        <div class="modal-header">
                            <h5 class="modal-title">Alterar Atividade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="unidade" class="form-control" id="unidade" value="{{ session()->get('codigoLotacaoAdministrativa') }}">
                            
                            <!-- <div class="form-group">
                                <label>Selecione e Equipe:</label>
                                <select name="selectAlterarEquipe" id="selectAlterarEquipe" class="form-control" required></select>
                            </div>

                            <div class="form-group">
                                <label>Nome da Célula:</label>
                                <input type="text" name="nomeAlterarEquipe" class="form-control" id="nomeAlterarEquipe" required>
                            </div>

                            <div class="form-group">
                                <label>Gestor da Célula:</label>
                                <select name="gestorAlterar" id="selectAlterarGestor" class="form-control" required></select>
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        &nbsp

        <button type="button" class="btn btn-danger p-1 m-1" data-toggle="modal" data-target="#modalExcluirAtividade">
            <i class="fas fa-times mx-2"></i>Excluir Atividade
        </button>

        <div class="modal fade" id="modalExcluirAtividade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="/url" id="formExcluirAtividade" onsubmit="noRefreshPost(this);return false">
                        <div class="modal-header">
                            <h5 class="modal-title">Excluir Atividade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <!-- <input type="hidden" name="unidade" class="form-control" id="unidade" value="{{ session()->get('codigoLotacaoAdministrativa') }}">
                            
                            <div class="form-group">
                                <label>Selecione e Atividade:</label>
                                <select name="selectExcluirEquipe" id="selectExcluirEquipe" class="form-control" required></select>
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> Gerencial</li>
            <li class="breadcrumb-item active"><a href="/"> Gestão de Atividades</a> </li>
        </ol>
    </div>
</div>

@stop 


@section('content')

<div class="card">
    <div class="card-body p-0 m-0 overflow-auto">
        <table id="tabelaEquipe" class="table table-bordered p-0">
            <thead id="headEquipe">
            </thead>
            <tbody id="bodyEquipe">
            </tbody>
        </table>
    </div>
</div> 


@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script src="{{ asset('js/portal/gerencial/atividades.js') }}"></script>
@stop
