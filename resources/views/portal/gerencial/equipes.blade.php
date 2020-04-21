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

                            <p>Deseja incluir esta atividade no atende ?</p>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" onclick="javascript:SIMnoCheck();" name="incluirEquipeAtende" id="CheckNao" value="false" required>
                                <label class="form-check-label" for="incluirEquipeAtende">Não</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" onclick="javascript:SIMnoCheck();" name="incluirEquipeAtende" id="CheckSim" value="true">
                                <label class="form-check-label" for="incluirEquipeAtende">Sim</label>
                            </div>
                            <div id="visibilidade" style="visibility:hidden">
                            <div>
                                <div class="close" data-dismiss="alert" aria-label="close"></div>

          
                                    Escolha um ícone para a equipe:
                                    <div class="row">
                                        <div class="col-sm -2">
                                            <button type="button" class="btn btn-link"><i class="fas fa-address-card fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-address-card fa-2x" checked></button>
                                            <button type="button" class="btn btn-link"><i class="fab fa-adn fa-2x"></i> <input type="radio" name="iconeEquipe" value="fab fa-adn fa-2x"></button>
                                        </div>
                                        <div class="col-sm -2">    
                                            <button type="button" class="btn btn-link"><i class="fas fa-at fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-at fa-2x"></button>
                                            <button type="button" class="btn btn-link"><i class="fas fa-book fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-book fa-2x"></button>
                                        </div>
                                        <div class="col-sm -2">
                                            <button type="button" class="btn btn-link"><i class="fab fa-bootstrap fa-2x"></i> <input type="radio" name="iconeEquipe" value="fab fa-bootstrap fa-2x"></button>
                                            <button type="button" class="btn btn-link"><i class="far fa-building fa-2x"></i> <input type="radio" name="iconeEquipe" value="far fa-building fa-2x"></button>
                                        </div>
                                        <div class="col-sm -2">
                                            <button type="button" class="btn btn-link"><i class="far fa-calendar-check fa-2x"></i> <input type="radio" name="iconeEquipe" value="far fa-calendar-check fa-2x"></button>
                                            <button type="button" class="btn btn-link"><i class="fas fa-cogs fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-cogs fa-2x"></button>
                                        </div>
                                        <div class="col-sm -2">
                                            <button type="button" class="btn btn-link"><i class="fas fa-dollar-sign fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-dollar-sign fa-2x"></button>
                                            <button type="button" class="btn btn-link"><i class="far fa-edit fa-2x"></i> <input type="radio" name="iconeEquipe" value="far fa-edit fa-2x"></button>
                                        </div>
                                        <div class="col-sm -2">
                                            <button type="button" class="btn btn-link"><i class="fas fa-exchange-alt fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-exchange-alt fa-2x"></button>
                                            <button type="button" class="btn btn-link"><i class="fab fa-expeditedssl fa-2x"></i> <input type="radio" name="iconeEquipe" value="fab fa-expeditedssl fa-2x"></button>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm -2">    
                                                <button type="button" class="btn btn-link"><i class="fas fa-gavel fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-gavel fa-2x"></button>
                                                <button type="button" class="btn btn-link"><i class="fas fa-headset fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-headset fa-2x"></button>
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-home fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-home fa-2x"></button>
                                                <button type="button" class="btn btn-link"><i class="fas fa-hotel fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-hotel fa-2x"></button>
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-house-damage fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-house-damage fa-2x"></button>
                                                <button type="button" class="btn btn-link"><i class="fab fa-houzz fa-2x"></i> <input type="radio" name="iconeEquipe" value="fab fa-houzz fa-2x"></button>
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-map-marked-alt fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-map-marked-alt fa-2x"></i></button>
                                                <button type="button" class="btn btn-link"><i class="far fa-question-circle fa-2x"></i> <input type="radio" name="iconeEquipe" value="far fa-question-circle fa-2x"></i></button>
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-star fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-star fa-2x"></i></button>
                                                <button type="button" class="btn btn-link"><i class="far fa-times-circle fa-2x"></i> <input type="radio" name="iconeEquipe" value="far fa-times-circle fa-2x"></i></button>
                                            </div>
                                            <div class="col-sm -2">
                                                <button type="button" class="btn btn-link"><i class="fas fa-users fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-users fa-2x"></i></button>
                                                <button type="button" class="btn btn-link"><i class="fas fa-tools fa-2x"></i> <input type="radio" name="iconeEquipe" value="fas fa-tools fa-2x"></i></button>
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
    <script>   
    function SIMnoCheck() {
    if (document.getElementById('CheckSim').checked) {
        document.getElementById('visibilidade').style.visibility = 'visible';
    } else {
        document.getElementById('visibilidade').style.visibility = 'hidden';
    }
}
    </script>
@stop
