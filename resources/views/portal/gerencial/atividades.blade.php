@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col">
        <h1 class="m-0 text-dark">
            Gestão de Atividades
        </h1>
    </div>

     <div class="col-sm-2">
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
                    <form action="/url" id="formCriarAtividade" onsubmit="noRefreshPost(this);return false">
                        <div class="modal-header">
                            <h5 class="modal-title">Criar Atividade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="unidade" class="form-control" id="unidade" value="{{ session()->get('codigoLotacaoAdministrativa') }}">

                            <!-- <div class="form-group">
                                <label>Nome da Célula:</label>
                                <input type="text" name="nomeCriarEquipe" class="form-control" id="nomeCriarEquipe" required>
                            </div>

                            <div class="form-group">
                                <label>Gestor da Célula:</label>
                                <select name="selectCriarEquipe" id="selectCriarEquipe" class="form-control" required></select>
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

<div class="row">
    <div class="col-md-12">
        <table id="tabelaEquipe" class="table table-bordered table-stripedy dataTable">
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