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
            Controle Leiloeiros
        </h1>
    </div><br>

    <div class="col-sm-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastraLeiloeiro">
                <i class="far fa-lg fa-edit"></i>
                Cadastrar Leiloeiro
            </button>
</div><br>

    <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"> <i class="fa fa-map-signs"></i> Fornecedores</li>
            <li class="breadcrumb-item active"><a href="/controle-leiloeiros/listar-leiloeiros"> Controle Leiloeiros</a> </li>
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
                            <table id="tblLeiloeiro" class="table table-bordered table-striped dataTable">
                                 <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nome</th>
                                        <th>Contrato</th>
                                        <th>Classificação</th>
                                        <th>Data de vencimento do contrato</th>
                                        <th>Leiloeiro</th>
                                        <th>Telefone</th>
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

<div class="modal fade" id="modalCadastraLeiloeiro" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method='post' action='/fornecedores/controle-leiloeiros' id="formCadastraLeiloeiro">
                {{ csrf_field() }} 
                    <div id="cardTop" style="background: linear-gradient(to right, #4F94CD , #63B8FF);" class="modal-header">
                        <h5 style="color: white;" class="modal-title" id="exampleModalScrollableTitle">Cadastrar Leiloeiro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <div class="modal-body px-0">
                <div style="overflow-y: hidden; height: calc(100vh - 15rem);">
                    <div class="px-2" style="overflow-y: auto; height: 100%;">
                        <p style="color: red;">Campos obrigatórios (*)</p>
                        

                        <button id="botaocaixa" class="btn btn-primary" type="button">Leiloeiro Caixa</button>
                        <button style="background: #85CD85; color: white;" id="botaoemgea" class="btn" type="button">Leiloeiro EMGEA</button>
                                                                      
                        <div>
                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea" id="InputClassificacao">
                                <p class="pt-3"></p>
                                <input id="input" type="text" name="classificacaoImoveisLeilao" class="form-control" style="display: none;">
                            </div>

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea">
                                <label>Contrato <span style="color: red;"> *</span> </label>
                                <input type="text" name="numeroContrato" class="form-control" autocomplete="off" required>
                            </div>                   

                            <div class="form-group collapse multi-collapse LeiloeiroEmgea ">
                                <label>Data de vencimento do contrato<span style="color: red;"> *</span> </label>
                                <input type="date" name="dataVencimentoContrato" id="datepicker" class="form-control datepicker" autocomplete="off" placeholder="Selecione no calendário">
                            </div>

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa ">
                                <label>Quantidade de leilões realizados<span style="color: red;"> *</span> </label>
                                <input type="number"  min="0" name="quantidadeLeiloesRealizados" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea">
                                <label>Nome<span style="color: red;"> *</span> </label>
                                <input type="text" name="nomeEmpresaAssessoraLeiloeiro" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea">
                                <label>Telefone<span style="color: red;"> *</span> </label>
                                <input type="text" name="telefoneEmpresaAssessoraLeiloeiro" class="form-control telefoneComum" id="telefoneEmpresaAssessoraLeiloeiro" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" placeholder="fixo ou celular" autocomplete="off" required>
                            </div>

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea">
                                <label>E-mail<span style="color: red;"> *</span> </label>
                                <input type="email" name="emailLeiloeiro" class="form-control" placeholder="exemplo@email.com.br" autocomplete="off" required>
                            </div>

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea">
                                <label>Leiloeiro<span style="color: red;"> *</span> </label>
                                <input type="text" name="nomeLeiloeiro" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea">
                                <label>Telefone do leiloeiro<span style="color: red;"> *</span> </label>
                                <input type="text" name="telefoneLeiloeiro" class="form-control telefoneComum" autocomplete="off" id="telefoneLeiloeiro" placeholder="fixo ou celular" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" required>
                            </div>

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea">
                                <label>E-mail do leiloeiro </label>
                                <input type="email" name="emailEmpresaAssessoraLeiloeiro" class="form-control" autocomplete="off" placeholder="exemplo@email.com.br">
                            </div>

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea">
                                <label>Endereço</label>
                                <input type="text" name="enderecoEmpresaAssessoraLeiloeiro" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea">
                                <label>Endereço do Leilão </label>
                                <input type="text" name="enderecoRealizacaoLeilao" class="form-control" autocomplete="off">
                            </div>                      

                            <div class="form-group collapse multi-collapse LeiloeiroCaixa LeiloeiroEmgea">
                                <label>Site</label>
                                <input type="text" name="siteEmpresaAssessoraLeiloeiro" class="form-control" autocomplete="off" placeholder="www.exemplo.com.br">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button id="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
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
<script src="{{ asset('js/portal/fornecedores/cadastro-leiloeiro.js') }}"></script>

@stop
