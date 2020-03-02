@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-3">
        <h1 class="m-0 text-dark">
            Gestão de Equipes
        </h1>
    </div>
    <div class="col-sm-3">
        <select name="selectGilie" id="selectGilie" class="form-control form-control-navbar">
            <option value="" selected>Selecione</option>
            <option value="BU">GILIE BU</option>
            <option value="SP">GILIE SP</option>
            <option value="RS">GILIE RS</option>
            <option value="SA">GILIE SA</option>
        </select>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> Gerencial</li>
            <li class="breadcrumb-item active"><a href="/"> Gestão de Equipes</a> </li>
        </ol>
    </div>
</div>

@stop


@section('content')
<hr class="pontilhado">

<div class="row">
    <div class="col-md-12" id="buttons">

        <button type="button" class="btn btn-primary p-1 m-1" data-toggle="modal" data-target="#modalCriarEquipe">
            <i class="fas fa-plus mx-2"></i>Criar Equipe
        </button>

        <div class="modal fade" id="modalCriarEquipe" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" action="#" id="formCriarEquipe">
                        <div class="modal-header">
                            <h5 class="modal-title">Criar Equipe</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="unidade" class="form-control" id="unidade" value="{{ session()->get('codigoLotacaoAdministrativa') }}">

                            <div class="form-group">
                                <label>Nome da Célula:</label>
                                <input type="text" name="nomeCelula" class="form-control" id="nomeCelula" required>
                            </div>

                            <div class="form-group">
                                <label>Gestor da Célula:</label>
                                <select name="gestorCriar" id="selectGestorCriar" class="form-control" required></select>
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

        <button type="button" class="btn btn-danger p-1 m-1" data-toggle="modal" data-target="#modalExcluirEquipe">
            <i class="fas fa-times mx-2"></i>Excluir Equipe
        </button>

        <div class="modal fade" id="modalExcluirEquipe" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" action="#" id="formExcluirEquipe">
                        <div class="modal-header">
                            <h5 class="modal-title">Excluir Equipe</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="unidade" class="form-control" id="unidade" value="{{ session()->get('codigoLotacaoAdministrativa') }}">
                            
                            <div class="form-group">
                                <label>Selecione e Equipe:</label>
                                <select name="excluirEquipe" id="selectExcluirEquipe" class="form-control" required></select>
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
</div>

<hr class="pontilhado">

<div id="equipes" class="row">

</div> 


@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
@stop


@section('js')
    <script src="{{ asset('js/portal/gerencial/equipes.js') }}"></script>
@stop
