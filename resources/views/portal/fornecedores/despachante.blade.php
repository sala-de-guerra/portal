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
            Controle Despachantes
        </h1>
    </div><br>

    <div class="col-sm-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraDespachante">
                <i class="far fa-lg fa-edit"></i>
                Cadastrar Despachante
            </button>
</div><br>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> Fornecedores</li>
            <li class="breadcrumb-item active"><a href="/fornecedores/controle-despachantes"> Controle Despachantes</a> </li>
        </ol>
    </div>
</div><br>


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">       
            <div class="card-body">
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tblfornecedores" class="table table-bordered table-striped dataTable">
                                 <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Despachante</th>
                                        <th>Contrato</th>
                                        <th>Data de vencimento do contrato</th>
                                        <th>CNPJ</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                    <tbody>

                                    </tbody>
      
                             </table>
                        </div>
                    </div>
                </div>

            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->


</div> <!-- /.row -->

<div class="modal fade" id="modalCadastraDespachante" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method='post' action='/fornecedores/controle-despachantes' id="formCadastraDemandaDespachante">
                {{ csrf_field() }} 
                    <div style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                        <h5 style="color: white;" class="modal-title" id="exampleModalScrollableTitle">Cadastrar Despachante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-0">
                        <div style="overflow-y: hidden; height: calc(100vh - 15rem);">
                        <div class="px-2" style="overflow-y: auto; height: 100%;">
                            <p style="color: red;">Campos obrigatórios (*)</p>
                        <div class="form-group">
                            <label>Número contrato <span style="color: red;"> *</span> </label>
                            <input type="text" name="numeroContrato" class="form-control" autocomplete="off" required>
                        </div>
                        <div id="field" class="container">
                        <div class="form-group">
                            <label>Vencimento do contrato<span style="color: red;"> *</span> </label>
                            <input type="date" name="dataVencimentoContrato" id="datepicker" class="form-control datepicker" autocomplete="off" placeholder="Selecione no calendário" required>
                        </div>

                        <div class="form-group">
                            <label>CNPJ despachante<span style="color: red;"> *</span> </label>
                            <input type="text" name="cnpjDespachante" class="form-control cnpj" id="cnpjDespachante" autocomplete="off" placeholder="00.000.000/0000-00" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Nome despachante<span style="color: red;"> *</span> </label>
                            <input type="text" name="nomeDespachante" class="form-control" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label>Telefone despachante<span style="color: red;"> *</span> </label>
                            <input type="text" name="telefoneDespachante" class="form-control telefoneComum" id="telefoneDespachante" placeholder="fixo ou celular" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label>E-mail despachante<span style="color: red;"> *</span> </label>
                            <input type="email" name="emailDespachante" class="form-control" placeholder="exemplo@email.com.br" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label>Nome do responsável<span style="color: red;"> *</span> </label>
                            <input type="text" name="nomePrimeiroResponsavelDespachante" class="form-control" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label>Telefone do responsável<span style="color: red;"> *</span> </label>
                            <input type="text" name="telefonePrimeiroResponsavelDespachante" class="form-control telefoneComum" autocomplete="off" id="telefonePrimeiroResponsavelDespachante" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" placeholder="fixo ou celular" required>
                        </div>

                        <div class="form-group">
                            <label>E-mail do responsável<span style="color: red;"> *</span> </label>
                            <input type="email" name="emailPrimeiroResponsavelDespachante" class="form-control" autocomplete="off" placeholder="exemplo@email.com.br" required>
                        </div>
                        <button id="b1" class="btn add-more" type="button" style="background: #4F94CD; color: white;">adicionar novo responsável</button>
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



 @stop 


@section('content')



@section('footer')


@stop

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
 
@stop


@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/portal/fornecedores/cadastro-despachante.js') }}"></script>
@stop
