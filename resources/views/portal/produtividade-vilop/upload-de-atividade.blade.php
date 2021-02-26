@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral')


@section('saudacao')
    <p class="col-lg-12 callout callout-info">
        Nesta página os dados poderão ser carregados em lote.
    </p>
    
@endsection


@section('conteudo')
</div>

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

<div class="row"> <!-- /.card-unidades -->
    <div class="col-md-12">
        <div class="card card-default">
            <div id="accordion" role="tablist" aria-multiselectable="true">
                <div class="card card-primary">
                    <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title mt-2" >Como fazer a atualização geral dos dados ?</h3>
                                </div>
                            </div>
                        </h5>
                    </div>

                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="text-justify"><b>1º -</b> Faça o Download da planilha com a Lista GD Indicadores de Produtividade-> <a href="/download/indicadores_produtividade_vilop.xlsx"><span style="color: green;"><b>Clique aqui para baixar</b></a></span><br>
                                                    <b>2º - </b>Preencha os dados. Clique para saber mais
                                                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalExemploPlanilha"><i style="color: #054f77; font-size: 13pt;" class="far fa-question-circle 5x"></i></button><br>
                                                    <b>3º - </b>Após preenchimento, salve o arquivo. <br>
                                                    <b>4º - </b>Clique em <b>"Escolher o arquivo"</b> procure onde está salva a Planilha<br>
                                                    <b>5º - </b>Espere aparecer a mensagem: <span style="color: green"><b>"Arquivo carregado com sucesso"</b></span><br>
                                                    <b>6º - </b>Clique em <span style="color: green"><b>Enviar</b></span><br>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="POST" action="/produtividade-vilop/carga-em-lote/envia" enctype="multipart/form-data">
                                            {{ csrf_field() }}

                                            {{-- <input type="file" name="arquivo" required><br><br> --}}
                                            {{-- <label class="inputFile" for='selecao-arquivo'>Selecionar o arquivo &#187;</label>
                                            <input id='selecao-arquivo' type='file' name="arquivo" required> --}}
                                            <label for="fupload" id="botaoEscolher" class="btn btn-info">Escolher o arquivo</label>
                                            <div class="nomeArquivo"></div>
                                            <input type="file" id="fupload" name="arquivo" accept=".xlsx, .xls" class="fupload form-control" style="display: none;"/>
                                            <br>
                                            <button type="submit" id="btnEnviar" style="display: none;" class="mb-2 btn btn-success">Enviar &nbsp &nbsp<i class="fas fa-file-upload"></i></button> 

                                        </form>
                                    </div>
                                </div>
                            </div>           
                        </div>
                    </div>
                </div>


                <!-- Modal Exemplo de Preenchimento da Planilha-->
                <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="modalExemploPlanilha">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(to right, #4F94CD , #63B8FF);">
                                <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Como preencher os dados da Planilha</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                    <table id="" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>COLUNA</th>
                                    <th>DETALHAMENTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>CGC - SIGLA</td>
                                    <td>Código da unidade - sem o dígito, somente os 4 números - responsável pelos microprocessos.<br>
                                    <em>Ex.: 7257 (Gilie/SP)</em>
                                    </td>
                                </tr>
                                <tr>
                                    <td>NOME_MACROATIVIDADE</td>
                                    <td>O macroprocesso é o meio pelo qual a unidade reúne os conjuntos de microprocessos para gerar valor e cumprir a sua missão.</td>
                                </tr>
                                <tr>
                                    <td>NOME_MICROATIVIDADE</td>
                                    <td>Os microprocessos são o conjunto de atividades e tarefas sequenciais com começo,meio e fim na unidade. O detalhamento deve acompanhar a possibilidade ou não de se apurar o volume, a fte alocada, o tempo gasto, bem como a necessidade de se apurar a produtividade de forma individual.</td>
                                </tr>
                                <tr>
                                    <td>MENSURAVEL</td>
                                    <td>Responder com SIM ou NÃO. <br> Possibilidade de se tangibilizar o volume, a fte alocada e tempo gasto.<br>Ex. Atividade não mensurável: administrativo, caixa postal, teams, apresentações, reuniões e etc.</td>
                                </tr>
                                <tr>
                                    <td>VOLUME_TOTAL_DEMANDA</td>
                                    <td>Volume total recebido no período de apuração.</td>
                                </tr>
                                <tr>
                                    <td>VOLUME_TOTAL_TRATADA</td>
                                    <td>Volume tratado no período de apuração.</td>
                                </tr>
                                <tr>
                                    <td>PERIODO_TRATADO_DE</td>
                                    <td>Data de início do período de apuração dos dados da volumetria.</td>
                                </tr>
                                <tr>
                                    <td>PERIODO_TRATADO_ATE</td>
                                    <td>Data final do período de apuração dos dados da volumetria.</td>
                                </tr>
                                <tr>
                                    <td>MEDIA_DIA</td>
                                    <td>Quantidade apurada dividida por 20 dias úteis.</td>
                                </tr>
                                <tr>
                                    <td>TEMPO_EM_MINUTOS</td>
                                    <td>Tempo gasto para realização de 1 volume do microprocesso.</td>
                                </tr>
                                <tr>
                                    <td>NIVEL_COMPLEXIDADE</td>
                                    <td>Responder com números de 1 a 5.<br>
                                    Avalie o Nível de Complexidade que melhor descreve o microprocesso de acordo com os critérios e a afirmativa abaixo e selecione o número correspondente na escala:<br>

                                    Escala 1: "Atividade composta por elementos básicos em que há um ou poucos fatores a serem apreciados, sendo de fácil entendimento e exigindo menor esforço intelectual para sua execução". <br>

                                    Escala 5: "Atividade que exige a análise de um conjunto de fatores de natureza diferenciada e interdependentes, demandando para sua execução a apreciação dos fatos sob diversos ângulos, requerendo capacidade intelectual elevada".</td>
                                </tr>
                                <tr>
                                    <td>NIVEL_AUTOMACAO</td>
                                    <td>Responder com números de 1 a 5.<br>
                                    Avalie o Nível de Automação que melhor descreve a atividade de acordo com os critérios e a afirmativa abaixo e selecione o número correspondente na escala:<br>

                                    Escala 1: "Atividade realizada 100% de forma manual, mediante análise de um empregado, sem utilização de ferramentas/sistemas que automatizem o trabalho".<br>

                                    Escala 5: "Atividade realizada de forma 100% automatizada, sem interferência manual por um empregado".</td>
                                </tr>
                                <tr>
                                    <td>GRAU_CRITICIDADE</td>
                                    <td>Responder com números de 1 a 5.<br>
                                    Avalie a Criticidade que melhor descreve a atividade de acordo com os critérios e a afirmativa abaixo abaixo e selecione o número correspondente na escala:<br>

                                    Escala 1: "Atividade com grau criticidade/relevância baixo para o alcance do objetivo da unidade ".<br>

                                    Escala 5: "Atividade de extrema criticidade/relevância para o alcance do objetivo da unidade e que representa a essência da unidade".
                                    </td>
                                </tr>
                                <tr>
                                    <td>GRAU_PADRONIZACAO</td>
                                    <td>Responder com números de 1 a 5.<br>
                                    Avalie o Nível de Padronização que melhor descreve o microprocesso de acordo com os critérios e a afirmativa abaixo e selecione o número correspondente na escala:<br>

                                    Escala 1: "Atividade seqüencial, uniforme e repetitiva. As etapas e habilidades exigidas são as mesmas, sem mudança/variação".<br>

                                    Escala 5: "Atividade diversificada e não repetitiva. As etapas e as habilidades exigidas são variadas, com alto grau de inovação".
                                    </td>
                                </tr>
                                <tr>
                                    <td>GRAU_AUTONOMIA</td>
                                    <td>Responder com números de 1 a 5.<br>
                                    Avalie o Grau de Autonomia que melhor descreve o microprocesso de acordo com os critérios e a afirmativa abaixo e selecione o número correspondente na escala:<br>

                                    Escala 1: "Atividade executada com baixo grau de autonomia em relação às outras unidades".<br>

                                    Escala 5: "Atividade executadas 100% pela unidade, com começo - meio - fim na unidade. Sem necessidade de comunicação/providência/interferência de outras unidades".
                                    </td>
                                </tr>
                                <tr>
                                    <td>SISTEMA_ORIGEM_INFORMACAO</td>
                                    <td>Especificar se existe algum sistema corporativo de controle.<br>
                                    <em>Ex: Chamados Serviços.caixa, Atender.Caixa, Atende, CIWEB, SIMCN, etc.</em>
                                    </td>
                                </tr>
                                <tr>
                                    <td>QTDE_PESSOAS_ALOCADAS</td>
                                    <td>A quantidade pessoas alocadas deve ser calculada com a soma da  dedicação dos funcionários que realizam o microprocesso. Pode ser número com casa decimal, formato "x,x". Deverá ser considerado que 1 funcionário trabalha por 300 min/dia, 20 dias por mês.<br>

                                    <em>Ex.: 3 funcionários se dedicam por 2,5 horas, ou 50% do seu tempo. A quantidade de pessoas alocadas no microprocesso é de 1,5 pessoas</em>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    

                        <table id="tbllistaUnidadesUpload" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>CGC - SIGLA</th>
                                    <th>NOME UNIDADE</th>
                                    <th>RESPONSÁVEL</th>
                                    <th>DATA UPLOAD</th>
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

</div>
@endsection

@section('js')
<script>

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 3, "desc" ]],     
        "pageLength": 10,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Mostrar _MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
}

$(document).ready(function(){
        $.getJSON('/produtividade-vilop/atividades-em-lote/dados', function(dados){
            $.each(dados, function(key, item) {
                let diaUpload = moment(item.DATA_UPLOAD).format("DD/MM/YYYY HH:mm")

                var linha =
                    `
                    <tr>
                        <td>${item.CGC_UNIDADE}</td>
                        <td>${item.NOME_UNIDADE}</td>
                        <td>${item.MATRICULA_RESPONSAVEL_UPLOAD}</td>
                        <td>${diaUpload}h</td>
                    </tr>        
                    `
        $(linha).appendTo('#tbllistaUnidadesUpload>tbody');
            }
        )}
    ).done(function() {
        _formataDatatableComData("tbllistaUnidadesUpload")
    })
})


$(function () {
    $('#fupload').change(function() {
        $('.nomeArquivo').html('<b style="color: green;">Arquivo carregado com sucesso</b>');
        $('.inputFile').remove();
        $('#botaoEscolher').remove();
        $('#btnEnviar').show();
    });
});

</script>

<script src="{{ asset('js/global/formata-data-datable.js') }}"></script>

@endsection