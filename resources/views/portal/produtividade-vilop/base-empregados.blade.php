<style>
    .cardMenor{
        background-color: #d0e0e3;
        color: #48586c;
    }
    .tituloCardMenor{
        text-align:right;
        color: #48586c;
   }
</style>
@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')


@section('saudacao')
<h3 class="card-title callout callout-info mt-1">
    <b>Lista Colaboradores: </b> <span id='unidade'> {{$unidadeCGC}} </span> - {{$unidadeNome}}
</h3> 
@endsection


@section('conteudo')
</div>

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

<div class="card-deck" style="color: #48586C; margin-bottom: 20px;">
    <div class="card border-0">
        <div class="card-body align-middle cardMenor">
            <h4 id=""><strong>32</strong></h4>
            <p class="tituloCardMenor">Total Colaboradores da Unidade</p>      
        </div>
    </div>
    
    <div class="card border-0">
        <div class="card-body align-middle cardMenor">
            <h4 id=""><strong>171</strong></h4>
            <p class="tituloCardMenor" >Total Cargos Gerenciais</p>      
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body align-middle cardMenor">
            <h4 id=""><strong>171</strong></h4>
            <p class="tituloCardMenor">Total Colaboradores de Apoio</p>      
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body align-middle cardMenor">
            <h4 id=""><strong>171</strong></h4>
            <p class="tituloCardMenor">Total Afastados</p>      
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table id="baseEmpregados" class="table table-hover table-striped table-bordered dataTable">
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Colaborador</th>
                            <th>Função</th>
                            <th>Enquadramento</th>
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
@endsection

@section('js')
<script src="{{ asset('js/global/formata-data-datable.js') }}"></script>
<script src="{{ asset('js/portal/produtividade/produtividade-vilop-lista-unidade.js') }}"></script>
@endsection