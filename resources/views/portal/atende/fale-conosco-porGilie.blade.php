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
            Abrir Atende
        </h1>
    </div><br>


     <div class="col">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item active"><i class="fa fa-map-signs"></i> <a href="/atende/abrir"> Atende</a> </li> 
            <li class="breadcrumb-item active"><i class="fa fa-map-signs"></i> <a href="/atende/abrir"> Abrir Demanda</a> </li> 
        </ol>
    </div>
</div><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
        
                    <div class="card-header">
                        <h3 class="card-title">Como abrir o Atende ?</h3>
                    </div> <!-- /.card-header -->
                    
                    <div class="card-body">
        
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-justify"><b>1º -</b> Selecione o tipo de dado que deseja para buscar o contrato<br>
                                    <b>2º - </b>Preencha o dado da pesquisa e clique na Lupa<br>
                                    <b>3º - </b>Localize o contrato<br>
                                    <b>4º - </b> Clique no botão Atende<br>
                                    <b>5º - </b>Escolha o assunto e preencha o formulário <br>
                                    <b>6º - </b>Faça o acompanhamento em <b>"Minhas Demandas"</b> ou no histórico do contrato<br></p>
                            </div><br>

                            
                    <li class="d-sm-block">
                        <form class="form-inline m-0"  action="/estoque-imoveis/consultar-imovel/resultado" method="post">
                            {{ csrf_field() }}
                            <select class="form-control mr-3" required>
                                <option value="" disabled selected>Selecione o tipo</option>
                                <option class="text-dark" value="numeroContrato">Contrato</option>
                                <option class="text-dark" value="cpfCnpjProponente">CPF/CNPJ proponente</option>
                                <option class="text-dark" value="nomeProponente">Nome proponente</option>
                                <option class="text-dark" value="enderecoImovel">Endereço imóvel</option>
                                <option class="text-dark" value="matriculaImovel">Matrícula do imóvel</option>
                                <option class="text-dark" value="cpfCnpjExMutuario">CPF/CNPJ ex-mutuário</option>
                                <option class="text-dark" value="nomeExMutuario">Nome ex-mutuário</option>
                            </select>
                            <div class="input-group nav-search-bar">
                                <input class="form-control form-control-navbar" type="text" name="valorVariavel" placeholder="Digite no mínimo 5 caracteres para pesquisar." required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" title="Pesquisar"> <i class="fas fa-search"></i> </button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <input type="hidden" id="numeroGilie" value="{{$numeroGilie}}">
    
            </div> <!-- /.card-body -->
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                 <small style="margin-left: -10%">Minha demanda não esta vinculada a um contrato</small>
                </button><br><br>
                <div class="collapse show" id="collapseExample">
                    <div class="col-sm-12 p-0">
                        <div class="options">
                            <select class="custom-select" id="selecao">
                                <option selected>Selecione a GILIE</option>
                                <option value="7109">GILIE/BR</option>
                                <option value="7242">GILIE/BU</option>
                                <option value="7243">GILIE/BE</option>
                                <option value="7244">GILIE/BH</option>
                                <option value="7247">GILIE/CT</option>
                                <option value="7248">GILIE/FO</option>
                                <option value="7249">GILIE/GO</option>
                                <option value="7251">GILIE/PO</option>
                                <option value="7253">GILIE/RE</option>
                                <option value="7254">GILIE/RJ</option>
                                <option value="7255">GILIE/SA</option>
                                <option value="7257">GILIE/SP</option>
                            </select>
                        </div>

                        <div class="col-sm-12 table-responsive p-0">
                            <table id="tblAtendeGenericoporgilie" class="table hover">
                                <thead>
                                    <tr>
                                        <th>Assunto</th>
                                        <th></th>
                                        <!-- <th>Botão provisório</th> -->
            
            
                                        <!-- <th>Vencimento</th> -->
                                    </tr>
                                </thead>
            
                                <tbody>
            
                                </tbody>
                                
                            </table>
                        </div> <!-- /.col-sm-12 -->

                    </div> <!-- /.col-sm-12 -->
                </div>
              </div>


  




        </div> <!-- /.card -->
    </div> <!-- /.col -->
</div> <!-- /.row --> 
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
<script src="{{ asset('js/global/formata-datable-dataVencimento.js') }}"></script>
<script src="{{ asset('js/global/formata_data.js') }}"></script>
<script src="{{ asset('js/portal/atende/fale-conosco-criar.js') }}"></script>
 <script>
    $('#selecao').change(function() {
        window.location = $(this).val();
    });
    </script>
@stop
