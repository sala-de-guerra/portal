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
            <option value="" selected>Selecione</option>
        </select>
    </div>

    <div id="buttons">

        <button type="button" class="btn btn-success p-1 m-1" data-toggle="modal" data-target="#modalCriarAtividade">
            <i class="fas fa-plus mx-2"></i>Criar Atividade
        </button>

        <div class="modal fade" id="modalCriarAtividade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" action="/url" id="formCriarAtividade">
                        <div class="modal-header">
                            <h5 class="modal-title">Criar Atividade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="idEquipe" class="form-control" id="idEquipeCriar" value="">
                            <div class="form-group">
                                <label>Selecione o tipo de atividade:</label>
                                <select name="atividadeSubordinada" id="selectTipoAtividadeCriar" class="form-control" required>
                                    <option value="" selected disabled>Selecione</option>
                                    <option value="false">Macroatividade</option>
                                    <option value="true">Microatividade</option>
                                </select>
                            </div>

                            <div class="form-group" id="divMacroatividadeVinculacaoCriar" style="display:none;">
                                <label>Selecione a Macroatividade de vinculação:</label>
                                <select name="idAtividadeSubordinante" id="selectMacroatividadeVinculacaoCriar" class="form-control">

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nome da Atividade:</label>
                                <input type="text" name="nomeAtividade" class="form-control" id="nomeAtividadeCriar" required>
                            </div>

                            <div class="form-group">
                                <label>Síntese da Atividade:</label>
                                <input type="text" name="sinteseAtividade" class="form-control" id="sinteseAtividadeCriar" required>
                            </div>

                            <div class="form-group">
                                <label>Prazo de Atendimento:</label>
                                <input type="number" name="prazoAtendimento" class="form-control" id="prazoAtendimentoCriar" required>
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

        &nbsp

        <button type="button" class="btn btn-primary p-1 m-1" data-toggle="modal" data-target="#modalAlterarAtividade">
            <i class="far fa-edit mx-2"></i>Alterar Atividade
        </button>

        <div class="modal fade" id="modalAlterarAtividade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="/url" method="put" id="formAlterarAtividade">
                        <div class="modal-header">
                            <h5 class="modal-title">Alterar Atividade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Atividade a Alterar:</label>
                                <select name="idAtividade" id="idAtividadeAlterar" class="form-control" required>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Nome da Atividade:</label>
                                <input type="text" name="nomeAtividade" class="form-control" id="nomeAtividadeAlterar">
                            </div>

                            <div class="form-group">
                                <label>Síntese da Atividade:</label>
                                <input type="text" name="sinteseAtividade" class="form-control" id="sinteseAtividadeAlterar">
                            </div>

                            <div class="form-group">
                                <label>Prazo de Atendimento:</label>
                                <input type="number" name="prazoAtendimento" class="form-control" id="prazoAtendimentoAlterar">
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

        &nbsp

        <button type="button" class="btn btn-danger p-1 m-1" data-toggle="modal" data-target="#modalExcluirAtividade">
            <i class="fas fa-times mx-2"></i>Excluir Atividade
        </button>

        <div class="modal fade" id="modalExcluirAtividade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="/url" method="delete" id="formExcluirAtividade">
                        <div class="modal-header">
                            <h5 class="modal-title">Excluir Atividade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Atividade a Excluir:</label>
                                <select name="idAtividade" id="idAtividadeExcluir" class="form-control" required>
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
    <div class="card-body p-0 m-0 overflow-auto" id="cardTabela">
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
