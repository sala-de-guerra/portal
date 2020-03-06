@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col">
        <h1 class="m-0 text-dark">
            Gestão de Equipes
        </h1>
    </div>

    <div class="col">
        <select name="selectGilie" id="selectGilie" class="form-control">
        </select>
    </div>

    <div id="buttons">

        <button type="button" class="btn btn-success p-1 m-1" data-toggle="modal" data-target="#modalCriarEquipe">
            <i class="fas fa-plus mx-2"></i>Criar Equipe
        </button>

        <div class="modal fade" id="modalCriarEquipe" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" action="/gerencial/gestao-equipes" id="formCriarEquipe">
                        <div class="modal-header">
                            <h5 class="modal-title">Criar Equipe</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="codigoUnidadeEquipe" class="form-control" id="unidade" value="{{ session()->get('codigoLotacaoAdministrativa') }}">

                            <div class="form-group">
                                <label>Nome da Célula:</label>
                                <input type="text" name="nomeEquipe" class="form-control" id="nomeCriarEquipe" required>
                            </div>

                            <div class="form-group">
                                <label>Gestor da Célula:</label>
                                <select name="matriculaGestor" id="selectCriarEquipe" class="form-control" required></select>
                            </div>

                            <!-- <input type="hidden" name="nomeGestor" id="nomeGestorCriar"> -->

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

        <button type="button" class="btn btn-primary p-1 m-1" data-toggle="modal" data-target="#modalAlterarEquipe">
            <i class="far fa-edit mx-2"></i>Alterar Equipe
        </button>

        <div class="modal fade" id="modalAlterarEquipe" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="put" action="/gerencial/gestao-equipes" id="formAlterarEquipe">
                        <div class="modal-header">
                            <h5 class="modal-title">Alterar Equipe</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="unidade" class="form-control" id="unidade" value="{{ session()->get('codigoLotacaoAdministrativa') }}">
                            
                            <div class="form-group">
                                <label>Selecione e Equipe:</label>
                                <select name="idEquipe" id="selectAlterarEquipe" class="form-control" required></select>
                            </div>

                            <div class="form-group">
                                <label>Novo nome da Célula:</label>
                                <input type="text" name="nomeEquipe" class="form-control" id="nomeAlterarEquipe">
                            </div>

                            <div class="form-group">
                                <label>Gestor da Célula:</label>
                                <select name="matriculaGestor" id="selectAlterarGestor" class="form-control"></select>
                            </div>

                            <input type="hidden" value="" name="nomeGestor" id="nomeGestorAlterar">

                            <div class="form-group">
                                <label>Eventual do Gestor:</label>
                                <select name="matriculaEventual" id="selectAlterarEventual" class="form-control"></select>
                            </div>

                            <input type="hidden" value="" name="nomeEventual" id="eventualAlterar">


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

        <button type="button" class="btn btn-danger p-1 m-1" data-toggle="modal" data-target="#modalExcluirEquipe">
            <i class="fas fa-times mx-2"></i>Excluir Equipe
        </button>

        <div class="modal fade" id="modalExcluirEquipe" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="delete" action="/gerencial/gestao-equipes" id="formExcluirEquipe">
                        <div class="modal-header">
                            <h5 class="modal-title">Excluir Equipe</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="unidade" class="form-control" id="unidade" value="{{ session()->get('codigoLotacaoAdministrativa') }}">
                            <input type="hidden" name="ativa" value="0">

                            <div class="form-group">
                                <label>Selecione e Equipe:</label>
                                <select name="idEquipe" id="selectExcluirEquipe" class="form-control" required></select>
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

    </div>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> Gerencial</li>
            <li class="breadcrumb-item active"><a href="/"> Gestão de Equipes</a> </li>
        </ol>
    </div>
    
</div>

@stop


@section('content')
<div id="equipes" class="row">
</div> 

@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script src="{{ asset('js/portal/gerencial/equipes.js') }}"></script>
@stop
