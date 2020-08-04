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
        <select name="selectEquipe" id="selectEquipe" class="form-control" onchange="colocaBotoes()">
            <option value="" selected>Selecione a Atividade</option>
        </select>
    </div>

    <div id="buttons">

        <button style="visibility: hidden;" type="button" class="btn btn-success p-1 m-1 botaoAtividade" data-toggle="modal" data-target="#modalCriarAtividade">
            <i class="fas fa-plus mx-2"></i>Criar Atividade
        </button>

        <div class="modal fade" id="modalCriarAtividade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" action="/gerencial/gestao-atividades" id="formCriarAtividade" class="form-gestao-atividades">
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
                                <label>Prazo de Atendimento (Dias úteis):</label>
                                <input type="number" name="prazoAtendimento" class="form-control" id="prazoAtendimentoCriar" required>
                            </div>

                            <p>Deseja incluir esta atividade no atende ?</p>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" onclick="javascript:SIMCheck();" name="incluirAtividadeAtende" id="CheckN" value="false" checked>
                                <label class="form-check-label">Não</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" onclick="javascript:SIMCheck();" name="incluirAtividadeAtende" id="CheckS" value="true">
                                <label class="form-check-label">Sim</label>
                            </div>
                            <div id="visibilidade" style="visibility:hidden">
                            <div>
                                <div class="close" data-dismiss="alert" aria-label="close"></div>
                                <div>
                                    <div class="close" data-dismiss="alert" aria-label="close"></div>

                                        Escolha um ícone para a atividade:
                                        <div class="row">
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-address-card fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-address-card fa-2x" checked>
                                                <button type="button" class="btn btn-link"><i class="fab fa-adn fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fab fa-adn fa-2x">
                                            </div>
                                            <div class="col-sm -2">    
                                                <button type="button" class="btn btn-link"><i class="fas fa-at fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-at fa-2x">
                                                <button type="button" class="btn btn-link"><i class="fas fa-book fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-book fa-2x">
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fab fa-bootstrap fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fab fa-bootstrap fa-2x">
                                                <button type="button" class="btn btn-link"><i class="far fa-building fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="far fa-building fa-2x">
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="far fa-calendar-check fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="far fa-calendar-check fa-2x">
                                                <button type="button" class="btn btn-link"><i class="fas fa-cogs fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-cogs fa-2x">
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-dollar-sign fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-dollar-sign fa-2x">
                                                <button type="button" class="btn btn-link"><i class="far fa-edit fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="far fa-edit fa-2x">
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-exchange-alt fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-exchange-alt fa-2x">
                                                <button type="button" class="btn btn-link"><i class="fab fa-expeditedssl fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fab fa-expeditedssl fa-2x">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm -2">    
                                                    <button type="button" class="btn btn-link"><i class="fas fa-gavel fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-gavel fa-2x">
                                                    <button type="button" class="btn btn-link"><i class="fas fa-headset fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-headset fa-2x">
                                                </div>
                                                <div class="col-sm -2">
                                                    <button type="button" class="btn btn-link"><i class="fas fa-home fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-home fa-2x">
                                                    <button type="button" class="btn btn-link"><i class="fas fa-hotel fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-hotel fa-2x">
                                                </div>
                                                <div class="col-sm -2">
                                                    <button type="button" class="btn btn-link"><i class="fas fa-house-damage fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-house-damage fa-2x">
                                                    <button type="button" class="btn btn-link"><i class="fab fa-houzz fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fab fa-houzz fa-2x">
                                                </div>
                                                <div class="col-sm -2">
                                                    <button type="button" class="btn btn-link"><i class="fas fa-map-marked-alt fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-map-marked-alt fa-2x"></i>
                                                    <button type="button" class="btn btn-link"><i class="far fa-question-circle fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="far fa-question-circle fa-2x"></i>
                                                </div>
                                                <div class="col-sm -2">
                                                    <button type="button" class="btn btn-link"><i class="fas fa-star fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-star fa-2x"></i>
                                                    <button type="button" class="btn btn-link"><i class="far fa-times-circle fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="far fa-times-circle fa-2x"></i>
                                                </div>
                                                <div class="col-sm -2">
                                                    <button type="button" class="btn btn-link"><i class="fas fa-users fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-users fa-2x"></i>
                                                    <button type="button" class="btn btn-link"><i class="fas fa-tools fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-tools fa-2x"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

        <button style="visibility: hidden;" type="button" class="btn btn-primary p-1 m-1 botaoAtividade" data-toggle="modal" data-target="#modalAlterarAtividade">
            <i class="far fa-edit mx-2"></i>Alterar Atividade
        </button>

        <div class="modal fade" id="modalAlterarAtividade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="/gerencial/gestao-atividades/" method="put" id="formAlterarAtividade" class="form-gestao-atividades">
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
                            <p> Deseja alterar o ícone da atividade:</p>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="incluirAtividadeAtende" id="naoaltera" value="false" checked>
                                <label class="form-check-label">Não</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="incluirAtividadeAtende" id="alteraicon" value="true">
                                <label class="form-check-label">Sim</label>
                            </div>
                            <div id="alteraVisibilidade" style="visibility:hidden">
                            <div>
                                <div class="close" data-dismiss="alert" aria-label="close"></div>
                                <div>
                                    <div class="close" data-dismiss="alert" aria-label="close"></div>

                                       
                                    <div class="row">
                                        <div class="col-sm -2">
                                            <button type="button" class="btn btn-link"><i class="fas fa-address-card fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-address-card fa-2x" checked>
                                            <button type="button" class="btn btn-link"><i class="fab fa-adn fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fab fa-adn fa-2x">
                                        </div>
                                        <div class="col-sm -2">    
                                            <button type="button" class="btn btn-link"><i class="fas fa-at fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-at fa-2x">
                                            <button type="button" class="btn btn-link"><i class="fas fa-book fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-book fa-2x">
                                        </div>
                                        <div class="col-sm -2">
                                            <button type="button" class="btn btn-link"><i class="fab fa-bootstrap fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fab fa-bootstrap fa-2x">
                                            <button type="button" class="btn btn-link"><i class="far fa-building fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="far fa-building fa-2x">
                                        </div>
                                        <div class="col-sm -2">
                                            <button type="button" class="btn btn-link"><i class="far fa-calendar-check fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="far fa-calendar-check fa-2x">
                                            <button type="button" class="btn btn-link"><i class="fas fa-cogs fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-cogs fa-2x">
                                        </div>
                                        <div class="col-sm -2">
                                            <button type="button" class="btn btn-link"><i class="fas fa-dollar-sign fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-dollar-sign fa-2x">
                                            <button type="button" class="btn btn-link"><i class="far fa-edit fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="far fa-edit fa-2x">
                                        </div>
                                        <div class="col-sm -2">
                                            <button type="button" class="btn btn-link"><i class="fas fa-exchange-alt fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-exchange-alt fa-2x">
                                            <button type="button" class="btn btn-link"><i class="fab fa-expeditedssl fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fab fa-expeditedssl fa-2x">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm -2">    
                                                <button type="button" class="btn btn-link"><i class="fas fa-gavel fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-gavel fa-2x">
                                                <button type="button" class="btn btn-link"><i class="fas fa-headset fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-headset fa-2x">
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-home fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-home fa-2x">
                                                <button type="button" class="btn btn-link"><i class="fas fa-hotel fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-hotel fa-2x">
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-house-damage fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fas fa-house-damage fa-2x">
                                                <button type="button" class="btn btn-link"><i class="fab fa-houzz fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="fab fa-houzz fa-2x">
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-map-marked-alt fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-map-marked-alt fa-2x"></i>
                                                <button type="button" class="btn btn-link"><i class="far fa-question-circle fa-2x"></i></button> <input type="radio" name="iconeAtividade" value="far fa-question-circle fa-2x"></i>
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-star fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-star fa-2x"></i>
                                                <button type="button" class="btn btn-link"><i class="far fa-times-circle fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="far fa-times-circle fa-2x"></i>
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-users fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-users fa-2x"></i>
                                                <button type="button" class="btn btn-link"><i class="fas fa-tools fa-2x"></i> </button><input type="radio" name="iconeAtividade" value="fas fa-tools fa-2x"></i>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

        <button style="visibility: hidden;" type="button" class="btn btn-danger p-1 m-1 botaoAtividade" data-toggle="modal" data-target="#modalExcluirAtividade">
            <i class="fas fa-times mx-2"></i>Excluir Atividade
        </button>

        <div class="modal fade" id="modalExcluirAtividade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="/gerencial/gestao-atividades/" method="delete" id="formExcluirAtividade" class="form-gestao-atividades">
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

<div class="card" id="cardTabelaDiv">
    <div class="card-body p-0 m-0" id="cardTabela">
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
