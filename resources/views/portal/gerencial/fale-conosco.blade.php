@extends('adminlte::page')

@section('title', 'Portal GILIE/SP')

@section('content_header')

@if (session('tituloMensagem'))
<div id="fadeOut" class="card text-white bg-{{ session('corMensagem') }}">
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
    <div class="col">
        <h1 class="m-0 text-dark">
            Fale Conosco
        </h1>
    </div><br>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"><i class="fa fa-map-signs"></i></i> Gerencial</li>
            <li class="breadcrumb-item active"><a href="/gerencial/gerenciar-demanda-generica">Fale Conosco</a> </li>    
        </ol>
    </div>
</div><br>

{{-- <div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" id="custon-tabs-li-fluxoAgencia">
                        <a class="nav-link" id="custom-tabs-one-fluxoAgencia-tab" data-toggle="pill" href="#custom-tabs-one-fluxoAgencia" role="tab" aria-controls="custom-tabs-one-fluxoAgencia" aria-selected="true">
                            <h5>Cadastrar</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-fluxoCCA">
                        <a class="nav-link" id="custom-tabs-one-fluxoCCA-tab" data-toggle="pill" href="#custom-tabs-one-fluxoCCA" role="tab" aria-controls="custom-tabs-one-fluxoCCA" aria-selected="false">
                            <h5>Gerenciar</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="">
                        <a style="display: none;" class="nav-link" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="">
                        <a class="nav-link" style="display: none;" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>
                    
            </div> --}}

            {{-- <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show active" id="custom-tabs-one-fluxoAgencia" role="tabpanel" aria-labelledby="custom-tabs-one-fluxoAgencia-tab">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">       
                            <div class="card-body">
                                <h5>Cadastrar Fale Conosco</h5><br>
                                <form method="post" action="/gerencial/cadastra-atividade-generica">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                      <label for="nomeAtividade">Nova Opção de Contato</label>
                                      <input type="text" class="form-control" name="nomeAtividade" id="nomeAtividade"  placeholder="Nome da Atividade" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="prazoAtendimento">Prazo de Atendimento</label>
                                      <input type="number" class="form-control" name="prazoAtendimento" id="prazoAtendimento" placeholder="Prazo de Atendimento" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Selecione o Destinatário</label>
                                        <select class="form-control" id="responsavelAtendimento" name="responsavelAtendimento">
                                        '<option value="" selected>Selecione</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                                  </form> <br><br>
                
                                  <div class="col-sm-12 table-responsive p-0">
                                    <table id="tblAtendeGenericoGerencial" class="table table-bordered table-striped dataTable">
                                        <thead>
                                            <tr>
                                                <th>Atividade</th>
                                                <th>Responsável</th>
                                                <th>Prazo Atendimento (dias)</th>
                                                <th>Ações</th>
                                                <!-- <th>Botão provisório</th> -->
                
                
                                                <!-- <th>Vencimento</th> -->
                                            </tr>
                                        </thead>
                
                                        <tbody>
                
                                        </tbody>
                                        
                                    </table>
                                </div> <!-- /.col-sm-12 -->





            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row --> --}}


 @stop 


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" id="custon-tabs-li-cadastrar">
                        <a class="nav-link" id="custom-tabs-one-cadastrar-tab" data-toggle="pill" href="#custom-tabs-one-cadastrar" role="tab" aria-controls="custom-tabs-one-cadastrar" aria-selected="true">
                            <h5>Cadastrar</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="custon-tabs-li-gerenciar">
                        <a class="nav-link" id="custom-tabs-one-gerenciar-tab" data-toggle="pill" href="#custom-tabs-one-gerenciar" role="tab" aria-controls="custom-tabs-one-gerenciar" aria-selected="false">
                            <h5>Gerenciar</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="">
                        <a style="display: none;" class="nav-link" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>

                    <li class="nav-item" id="">
                        <a class="nav-link" style="display: none;" id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="false">
                            <h5>Exemplo</h5>
                        </a>
                    </li>
                    
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show active" id="custom-tabs-one-cadastrar" role="tabpanel" aria-labelledby="custom-tabs-one-cadastrar-tab">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">       
                                <div class="card-body">
                                    <h5>Cadastrar Fale Conosco</h5><br>
                                    <form method="post" action="/gerencial/cadastra-atividade-generica">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                          <label for="nomeAtividade">Nova Opção de Contato</label>
                                          <input type="text" class="form-control" name="nomeAtividade" id="nomeAtividade"  placeholder="Nome da Atividade" required>
                                        </div>
                                        <div class="form-group">
                                          <label for="prazoAtendimento">Prazo de Atendimento</label>
                                          <input type="number" class="form-control" name="prazoAtendimento" id="prazoAtendimento" placeholder="Prazo de Atendimento" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Selecione o Destinatário</label>
                                            <select class="form-control" id="responsavelAtendimento" name="responsavelAtendimento">
                                            '<option value="" selected>Selecione</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                                      </form> <br><br>
                    
                                      <div class="col-sm-12 table-responsive p-0">
                                        <table id="tblAtendeGenericoGerencial" class="table table-bordered table-striped dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Atividade</th>
                                                    <th>Responsável</th>
                                                    <th>Prazo Atendimento (dias)</th>
                                                    <th>Ações</th>
                                                    <!-- <th>Botão provisório</th> -->
                    
                    
                                                    <!-- <th>Vencimento</th> -->
                                                </tr>
                                            </thead>
                    
                                            <tbody>
                    
                                            </tbody>
                                            
                                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="tab-pane fade" id="custom-tabs-one-gerenciar" role="tabpanel" aria-labelledby="custom-tabs-one-gerenciar-tab">
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tblGerenciarFaleconosco" class="table table-bordered table-striped dataTable"> 

                                        <thead>
                                            <tr>
                                                <th>Responsável</th>
                                                <th>Atividade</th>
                                                <th>Limite atendimento</th>
                                                <th>Assunto</th>
                                                <th>Breve descrição</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
 
@stop


@section('js')
<script src="{{ asset('js/global/formata_datatable.js') }}"></script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/portal/atende/gestao-fale-conosco.js') }}"></script>
@stop
