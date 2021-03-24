@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')

@section('saudacao')
<h4>Seja bem vindo!</h4>    
@endsection

@section('conteudo')
    @if (session('tituloMensagem'))
        <div class="card text-white bg-{{ session('corMensagem') }}">
            <div class="card-header">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{ session('tituloMensagem') }}</strong></h5>
                    <br>
                    <p class="card-text">{{ session('corpoMensagem') }}</p>
                </div>
            </div>
        </div>
    @endif


            <div class="col-12">
                <div class="card">
                    <div class="card-header"> <h3 class="card-title">PESQUISA - GD INDICADORES DE PRODUTIVIDADE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                           </button>
                        </div>
                    </div>
                            
                    <div class="card-body">


                        <form 
                        method="post" 
                        action="/produtividade-vilop/cria-macro-atividade" 
                        id="formMacroatividade"
                        class="form-inline">
                                    <div class="modal-body">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <input type="hidden" name="cgcUnidade" value="{{$unidadeCGC}}">
                                            <input type="hidden" name="nomeUnidade" value="{{$unidadeNome}}">
                                            <label for="nomeMacroAtividade" class="mt-0">Estabeleça as macroatividades da unidade abaixo</label>
                                            <a 
                                                tabindex="-1"
                                                href="#" data-toggle="tooltip" data-placement="top" 
                                                data-html="true"
                                                title="<p>Use este campo para criar as macroatividades da unidade abaixo.</p>
                                                <p> Caso deseje alterar outra unidade é necessário navegar pela busca acima no campo 'Pesquise por CGC'. </p>
                                                ">
                                                <span><i class="far fa-question-circle"></i></span>
                                            </a> 
                                                                                        
                                            <input 
                                            type="text" 
                                            class="form-control-plaintext mt-1 border-bottom" 
                                            id="nomeMacroAtividade" 
                                            rows="1" 
                                            name="nomeMacroAtividade" 
                                            title="Atenção! Neste campo já se inicia o preenchimento da pesquisa"
                                            placeholder="Digite aqui o nome da MACROATIVIDADE para unidade abaixo..." autofocus required>
                                            
                                            <button 
                                                type="submit" 
                                                class=" form-group btn btn-primary mt-1 "
                                                {{-- title="prazo encerrado em 12/03/2020" --}}
                                                >
                                                Criar MACROATIVIDADE</button>
                                            
                                        </div>

                                    </div>

                                 
                                    {{-- <div class="modal-footer">
                                                                      
                                        
                                    </div> --}}
                                </form>

                    </div>


        

          <!-- Modal Criar Micro Atividade
            <div class="modal fade" id="modalCriarMicroatividade" tabindex="-1" role="dialog" aria-labelledby="ModalMicroatividade" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalMicroatividade">Criar Microatividade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="/produtividade-vilop/cria-micro-atividade" id="formMicroatividade">
                            <div class="modal-body">
                                {{ csrf_field() }}

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nomeMicroAtividade">Nome da Micro Atividade:</label>
                                        <input type="text" class="form-control" id="nomeMicroAtividade" rows="1" name="nomeMicroAtividade" placeholder="Digite aqui..." required>
                                    </div>

                                    <div class="form-group col-md-6">
                                            <legend class="col-form-label col-sm-6 pt-0"><b>Esta atividade é Mensurável?</b></legend>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="mensuravel" id="exampleRadios1" value="S" checked>
                                                <label class="custom-control-label" for="exampleRadios1">Sim</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="mensuravel" id="exampleRadios2" value="N">
                                                <label class="custom-control-label" for="exampleRadios2">Não</label>
                                            </div>
                                        
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="volTotDemanda">Volume Total de Demanda</label>

                                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalInfoVolTot"><i style="color: #054f77; font-size: 13pt;" class="fas fa-info-circle"></i></button>

                                        <div class="modal fade" id="modalInfoVolTot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        aqui vai o texto
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="text" class="form-control" id="volTotDemanda" name="volumeTotalDemanda" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="volTratDemanda">Volume Demanda Tratada</label>
                                        <input type="text" class="form-control" id="volTratDemanda" name="volumeTotalTratada" required> 
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-row">
                                            <legend class="col-form-label pt-0"><b>Período de Apuração</b></legend>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="periodoTratadoDe">Informar Data de Início</label>
                                                    <input type="date" class="form-control" name="periodoTratadoDe" autocomplete="off" id="periodoTratadoDe" placeholder="DD/MM/AAAA" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="periodoTratadoate">Informar Data Final</label>
                                                    <input type="date" class="form-control" name="periodoTratadoate" autocomplete="off" id="periodoTratadoate" placeholder="DD/MM/AAAA" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                

                                    <div class="col-md-4 mb-3">
                                        <label for="mediaDia">Média/Dia</label>
                                        <input type="text" class="form-control" id="mediaDia" name="mediaDia" required> 
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="tempoMin">Tempo Realização do Microprocesso</label>
                                        <input type="text" class="form-control" id="tempoMin" name="tempoEmMinutos" placeholder="Valor em minutos"required> 
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                -->
        </div>
      </div>
    </div>

    <div  style="display: none;" class="row" id='cardTabela'>
        <div class="col-md-12">
            <div class="card card-default">
    
                <div class="card-header">
                    <h3 class="card-title callout callout-info mt-1">
                        <span id='unidade'> {{$unidadeCGC}} </span> - {{$unidadeNome}}
                    </h3>
                    
                    
                    {{-- <div class="float-right">
                        <form action="/produtividade-vilop/indicadores/view/{{$unidadeCGC}}">
                            <button type="submit" class="btn btn-warning disabled"><i class="fas fa-chart-bar"> Indicadores</i></button>
                        </form>
                    </div> --}}


                </div> <!-- /.card-header -->
                <input type="hidden" id='tokenVilop' value="{{ csrf_token() }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tblAtividadesVilop" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>MACROATIVIDADE</th>
                                        <th>MICROATIVIDADE</th>
                                        <th>AÇÃO CRIAR MICROATIVIDADE </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>                  

                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->  
    </div> <!-- /.row -->
   
    <div style="display: none;" class="row" id='cardExplicacao'> <!-- /.card-explicação-Macro -->
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title callout callout-info mt-1">
                        <span id='unidade'> {{$unidadeCGC}} </span> - {{$unidadeNome}}
                    </h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Ainda não existem macroatividades cadastradas para a unidade!</p>
                            <p>Para começar a incluir as MACROATIVIDADES da unidade <strong> {{$unidadeCGC}} - {{$unidadeNome}} </strong>, clicar no botão azul acima preenchendo o nome da Macroatividade. </p>
                            <p>Caso a unidade a qual se pretende preencher as macro e microatividades seja diferente da de lotação, orientamos pesquisar pelo código da unidade em barra de pesquisa 'Pesquise pelo CGC'. Ex. GILIE/SP, pesquisa: 7257 </p>
                        </div>
                    </div>                  

                </div> <!-- /.card-body -->


                



            </div> <!-- /.card -->
        </div> <!-- /.col -->  
    </div> <!-- /.row -->

 
@endsection



@section('js')

<script>

$('[name="dataResposta"]').mask('00/00/0000');

    $('#selecao').change(function() {
        window.location = $(this).val();
    });


$('.popover-dismiss').popover({
  trigger: 'focus'
})

function focarInput() {
     document.getElementById("nomeMacroAtividade").focus();
}

</script>
<script src="{{ asset('js\global\formata-data-datable.js') }}"></script>
<script src="{{ asset('js/portal/produtividade/produtividade-vilop.js') }}"></script>





@stop