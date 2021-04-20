@extends('portal.produtividade-vilop.template')
@extends('portal.produtividade-vilop.componentes.menu-lateral') 
<style>
    :root {
        --success: #28a745;
        --info: #17a2b8;
        --warning: #ffc107;
        --danger: #dc3545;
    }

    td{
        font-size: 14px;
        text-align: center;
        color: #48586c;
    }

    td:hover{
        font-size:15px;
    }

    .TotUnidade{
        color: white;
        background: -webkit-gradient(linear, left top, right top, from(#66CFBF), to(#40A797));
        background: -moz-linear-gradient(bottom, #66CFBF, #40A797);
    }

    #container{
        padding-left: 100px;
        position: relative;
        margin: auto;
        overflow: hidden;
        width: 250px;
        height: 90px;
    }
  
    .layout-align{
        padding-left: 20px;
        transform: scale(0.9);
    }
    
    #score-meter-1{
        width: 100px;
        height: 50px;
        border-top-left-radius: 360px;
        border-top-right-radius: 360px;
        overflow: hidden;
        position: relative;
    }

    #scorer-1-inner-div{
        position: absolute;
        left: 20%;
        top: 40%;
        width: 60%;
        height: 60%;
        border-top-left-radius: 120px;
        border-top-right-radius: 120px;
        background-color: #eff5f6;
        z-index: 2;
    }

    #scorer-1-inner-div-2{
        position: absolute;
        left: 0%;
        top: 0%;
        z-index: 4;
        width: 100%;
        height: 100%;
        border-top-left-radius: 120px;
        border-top-right-radius: 120px;
        background-color: #A3CD3B;
        transform-origin: bottom center;
        transform: rotate(-130deg);
        z-index: 0;
    }

    #scorer-1-inner-div-3{
        position: absolute;
        right: 0%;
        top: 0%;
        z-index: 4;
        width: 100%;
        height: 100%;
        border-top-left-radius: 120px;
        border-top-right-radius: 120px;
        background-color: red;
        transform-origin: bottom center;
        transform: rotate(130deg);
        z-index: 0
    }

    #scorer-1-inner-div-4{
        position: absolute;
        left: 20px;
        top: -2px;
        width: 50;
        height: 50;
        border-left: 30px solid transparent;
        border-right: 30px solid transparent;
        border-bottom: 50px solid #FFCA3D;
        transform: rotate(180deg);
    }

    .scorer-1-tick {
        position: absolute;
        top: 40%;
        left: -250%;
        width: 300%;
        height: 5px;
        background-color: #000000;
        animation-name: ticker-mover-1;
        animation-duration: 5s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
        border-top-left-radius: 50%;
        border-bottom-left-radius: 50%;
        border-top-right-radius: 5%;
        border-bottom-right-radius: 5%;
    }

    #scorer-1-inner-div-5{
        position: absolute;
        left: 45%;
        top: 80%;
        width: 10%;
        height: 20%;
        border-radius: 50%;
        background-color: #000000;
        z-index: 2;
    }

    @keyframes ticker-mover-1 {
        0% {
            transform-origin: right center;
            transform: rotate(0deg);
        }
        33% {
            transform-origin: right center;
            transform: rotate(150deg);
        }
        66% {
            transform-origin: right center;
            transform: rotate(150deg);
        }
        100% {
            transform-origin:right center;
            transform: rotate(150deg);
        }
    }

   .valorSuper{
       font-size: 20px;
   }

   .tituloCard{
        text-align:right;
   }

   .tituloCardMenor{
        text-align:right;
        color: #48586c;
   }

    .cardMenor{
        background-color: #d0e0e3;
        color: #48586c;
    }

    .cardMedio{
        background-color: #eff5f6;
        color: #48586c;
    }

    .colunaNormal{
        text-align:center;
        font-size: 14px;
        color: #48586c;
    }

    .colunaDiferenciada{
        text-align:center;
        background-color: rgba(239, 245, 246, 0.5);
        font-size: 14px;
        color: #48586c;
    }

    .estiloTotal{
        cursor:pointer; 
        white-space: nowrap;
    }

    .atendimentos{
        color: #004c8c !important;
    }

    #scoreUnidade {
        width: 250px; 
        font-size: 13px;
        white-space: nowrap;
        margin-left: -20px;
        color: #48586c;
    }

    .tituloMicro{
        font-size: 10px !important;
    }
   

</style>



@section('saudacao')

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
<div class="d-flex justify-content-between">
    <div class="col-sm-4">
        <h3 class="card-title callout callout-info mt-3">
            <span id="unidade">{{$unidadeCGC}}</span> - {{$unidadeNome}}
        </h3>
    </div>

    <div class="col-sm-2">
        <div class="container" style="align-items:center;">
            <div class="layout-align" > 
                <div id="score-meter-1" class="layout-align">
                    {{-- <div id="scorer-1-inner-div">
                        <div id="scorer-1-inner-div-5">
                            <div class="scorer-1-tick">
                            </div>
                        </div>
                    </div>
                    <div id="scorer-1-inner-div-2">
                    </div>
                    <div id="scorer-1-inner-div-3">
                    </div>
                    <div id="scorer-1-inner-div-4">
                    </div>
                </div> --}}
                {{-- <span id="scoreUnidade">Unidade com Sobrecarga</span> --}}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('conteudo')
</div>

<div id='cardTabela'>
<div class="card-deck">
    <div class="card TotUnidade">
        <div class="card-body">
            <div class="container"> 
                <h1 id="produtividadeUnidade"></h1>
                <h4 class="tituloCard">Produtividade</h4>
            </div>
            <a data-toggle="collapse" aria-expanded="false" aria-controls="listaProdutividade" href="#listaProdutividade" class="small-box-footer float-right" role="button" id="listagemProdutividade"><i id="iconeProdutividade" class="fa fa-angle-double-down" style="color: white"></i></a>       
        </div>           
    </div>
    <div class="card TotUnidade">
        <div class="card-body align-middle">
            <h1 id="desempenhoUnidade" ></h1>
            <h4 class="tituloCard">Desempenho</h4>      
        </div>
    </div>
    <div class="card TotUnidade">
        <div class="card-body align-middle">
            <h1 id="pessoasUnidade"></h1>
            <h4 class="tituloCard">Pessoas</h4>    
        </div>
    </div>
    <div class="card TotUnidade">
        <div class="card-body">
            <div class="container"> 
                <h1 id="fteUnidade"></h1>
                <h4 class="tituloCard">FTE Apurada</h4>
            </div>
            <a data-toggle="collapse" aria-expanded="false" aria-controls="listaFTE" href="#listaFTE" class="small-box-footer float-right" role="button" id="listagemFTE"><i id="iconeFTE" class="fa fa-angle-double-down" style="color: white"></i></a>       
        </div>
    </div>
    <div class="card TotUnidade">
        <div class="card-body align-middle">
            <h1 id="lapUnidade"></h1>
            <h4 class="tituloCard">LAP Unidade</h4>    
        </div>
    </div>
</div>

<br>

<div class="collapse" id="listaProdutividade">
    <div class="card card-body card-outline">
        <div class="d-flex justify-content-between" style="color: #48586c">
            <h2 class="card-title"><b>Produtividade - Detalhamento</b></h2>
            
                <div class="form-group">
                    <label for="filtroVisao">Escolha a visão (filtro):</label>
                    <select class="form-control" id="filtroVisao">
                        <option value="totalSemGAS" >Total sem Gestores/Afastados/Suporte</option>
                        <option value="apenasMensuraveis" selected>Apenas Atividades Mensuráveis</option>
                    </select>
                </div>
            
        </div>
        <div class="col-sm-12" style="color: #48586C">
            <div class="card-deck">
                <div class="card border-0" id="cardTotalMicroatividades">
                    <div class="card-body align-middle cardMenor">
                        <h4 id="totalMicroatividades"></h4>
                        <p class="tituloCardMenor">Qtdade Microatividades</p>      
                    </div>
                </div>
                <div class="card border-0" id="cardTotalHorasAlocadas">
                    <div class="card-body align-middle cardMenor">
                        <h4 id="totalHorasAlocadas"></h4>
                        <p class="tituloCardMenor" >Qtdade Horas Alocadas</p>      
                    </div>
                </div>
                <div class="card border-0" id="cardTotalUplopHora">
                    <div class="card-body align-middle cardMenor">
                        <h4 id="totalUplopHora"></h4>
                        <p class="tituloCardMenor" >Qtdade UPLop/</br>Hora</p>      
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle cardMenor">
                        <h4 id="totalUplopDevidaUnidade"></h4>
                        <p class="tituloCardMenor" >UPLop Devida/</br>Unidade</p>      
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle cardMenor">
                        <h4 id="totalUplopProduzidaUnidade"></h4>
                        <p class="tituloCardMenor" >UPLop Produzida/</br>Unidade</p>    
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle cardMenor">
                        <h4 id="totalUplopDevidaEmpregado"></h4>
                        <p class="tituloCardMenor" >UPLop Devida/</br>Empregado</p>
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle cardMenor">
                        <h4 id="totalUplopProduzidaEmpregado"></h4>
                        <p class="tituloCardMenor" >UPLop Produzida/</br> Empregado</p>     
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle cardMenor">
                        <h4 id="totalLapLiquida"></h4>
                        <p class="tituloCardMenor" >LAP LÍQUIDA</p>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="collapse" id="listaFTE">
    <div class="card card-body card-outline">
        <div class="d-flex justify-content-start" style="color: #48586c">
            <h2 class="card-title"><b>FTE - Detalhamento</b></h2>&nbsp&nbsp&nbsp
        </div>
        <div class="col-sm-12" style="color: #48586C">
            <div class="card-deck">
                <div class="card border-0">
                    <div class="card-body align-middle cardMedio">
                        <h4 id="fteApuradaMensuravel"></h4>
                        <p class="tituloCardMenor" >FTE Apurada Mensurável</p>    
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle cardMedio">
                        <h4 id="fteTecnicaMensuravel"></h4>
                        <p class="tituloCardMenor" >FTE Técnica Mensurável</p>
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle cardMedio">
                        <h4 id="fteNaoMensuravel"></h4>
                        <p class="tituloCardMenor" >FTE Não Mensurável</p>     
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle cardMedio">
                        <h4 id="fteGestores"></h4>
                        <p class="tituloCardMenor" >Gestores</p>    
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body align-middle cardMedio">
                        <h4 id="fteAfastados"></h4>
                        <p class="tituloCardMenor">Afastados</p>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<div id='principal'>

</div>


</div>

<div style="display: none;" class="row" id='cardExplicacao'>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Ainda não existem dados cadastrados para esta unidade!</p>

                    </div>
                </div>                  
            </div>
        </div>
    </div> 
</div> 



@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/produtividade/relatorio.css') }}">
@endsection

@section('js')
<script>
    $('#buscarCGC').submit( function(e) {
    e.preventDefault();
    var $input = $(this).find('[name=numeroCGC]');
    window.location = `/produtividade-vilop/relatorio-geral/${$input.val()}`
    })
    $('#buscaCGC').attr('id','the_new_id');

    $('#the_new_id').submit( function(e) {
    e.preventDefault();
    var $input = $(this).find('[name=numeroCGC]');
    window.location = `/produtividade-vilop/relatorio-geral/${$input.val()}`
    })
  /*
$('#listagemFTE').click(function(){
    if ('#iconeFTE' == "class='fa fa-angle-double-down'")
    $('#iconeFTE').addClass('fa fa-angle-double-up');
    $('#iconeFTE').removeClass('fa fa-angle-double-down');
    $('#listagemProdutividade').hide()
});
*/
$('#listagemProdutividade').click(function(){
    $('#iconeProdutividade').toggleClass('fa fa-angle-double-up fa fa-angle-double-down');
});

var unidade = $('#unidade').text()
unidade = unidade.trim();

$(document).ready(function(){
    $(".menu-hamburguer").click(); 

    $.getJSON('/produtividade-vilop/api/relatorio-cards/'+unidade, function(dados){
        $.each(dados, function(key, item){

            var valueProdutividade2 = item.PRODUTIVIDADE_G2
            var valProdutividade2 = parseFloat(valueProdutividade2)
            var valorProdutividade2 = valProdutividade2.toLocaleString('pt-BR')

            $('#produtividadeUnidade').html('<b>'+valorProdutividade2+'</b> <sup style="font-size: 20px">%</sup>' )

            $('#cardTotalMicroatividades').css("display", "none");
            $('#cardTotalHorasAlocadas').css("display", "none");
            $('#cardTotalUplopHora').css("display", "none");


            //$('#totalMicroatividades').html('<b>'+ '' +'</b>')
            //$('#totalHorasAlocadas').html('<b>'+ '' +'</b>')
            //$('#totalUplopHora').html('<b>'+ '' +'</b>')
            $('#totalUplopDevidaUnidade').html('<b>'+ item.QT_UPLOP_DEVIDA_G2.replace('.',',') +'</b>')
            $('#totalUplopProduzidaUnidade').html('<b>'+ item.QT_UPLOP_PRODUZIDA_G2.replace('.',',') +'</b>')
            $('#totalUplopDevidaEmpregado').html('<b>'+ item.QT_UPLOP_DEVIDA_EMPREGADO_G2.replace('.',',') +'</b>')
            $('#totalUplopProduzidaEmpregado').html('<b>'+ item.QT_UPOP_PRODUZIDA_EMPREGADO_G2.replace('.',',') +'</b>')
            $('#totalLapLiquida').html('<b>'+ item.LAP_LIQUIDA_G2.replace('.',',') +'</b>')

                $("#filtroVisao").change(function(){
                    if ($(this).val() === "totalSemGAS") {
                        
                        $('#cardTotalMicroatividades').css("display", "block");
                        $('#cardTotalHorasAlocadas').css("display", "block");
                        $('#cardTotalUplopHora').css("display", "block");

                        var valueProdutividade = item.PRODUTIVIDADE
                        var valProdutividade = parseFloat(valueProdutividade)
                        var valorProdutividade = valProdutividade.toLocaleString('pt-BR');

                        $('#produtividadeUnidade').html('<b>'+item.PRODUTIVIDADE.replace('.',',')+'</b> <sup style="font-size: 20px">%</sup>' )
                        $('#totalMicroatividades').html('<b>'+ item.QT_MICRO +'</b>')
                        $('#totalHorasAlocadas').html('<b>'+ item.QT_HORAS_ALOCADAS_G1.replace('.',',') +'</b>')
                        $('#totalUplopHora').html('<b>'+ item.QT_UPLOP_POR_HORA_G1.replace('.',',') +'</b>')
                        $('#totalUplopDevidaUnidade').html('<b>'+ item.QT_UPLOP_DEVIDA_G1.replace('.',',') +'</b>')
                        $('#totalUplopProduzidaUnidade').html('<b>'+ item.QT_UPLOP_PRODUZIDA_G1.replace('.',',') +'</b>')
                        $('#totalUplopDevidaEmpregado').html('<b>'+ item.QT_UPLOP_DEVIDA_EMPREGADO_G1.replace('.',',') +'</b>')
                        $('#totalUplopProduzidaEmpregado').html('<b>'+ item.QT_UPLOP_PRODUZIDA_EMPREGADO_G1.replace('.',',') +'</b>')
                        $('#totalLapLiquida').html('<b>'+ item.LAP_LIQUIDA_G1.replace('.',',') +'</b>')
                    }else{
                        var valueProdutividade2 = item.PRODUTIVIDADE_G2
                        var valProdutividade2 = parseFloat(valueProdutividade2)
                        var valorProdutividade2 = valProdutividade2.toLocaleString('pt-BR')

                        $('#produtividadeUnidade').html('<b>'+valorProdutividade2+'</b> <sup style="font-size: 20px">%</sup>' )

                        $('#cardTotalMicroatividades').css("display", "none");
                        $('#cardTotalHorasAlocadas').css("display", "none");
                        $('#cardTotalUplopHora').css("display", "none");

                        //$('#totalMicroatividades').html('<b>'+ 'pendente' +'</b>')
                        //$('#totalHorasAlocadas').html('<b>'+ 'pendente' +'</b>')
                        //$('#totalUplopHora').html('<b>'+ 'pendente' +'</b>')
                        $('#totalUplopDevidaUnidade').html('<b>'+ item.QT_UPLOP_DEVIDA_G2.replace('.',',') +'</b>')
                        $('#totalUplopProduzidaUnidade').html('<b>'+ item.QT_UPLOP_PRODUZIDA_G2.replace('.',',') +'</b>')
                        $('#totalUplopDevidaEmpregado').html('<b>'+ item.QT_UPLOP_DEVIDA_EMPREGADO_G2.replace('.',',') +'</b>')
                        $('#totalUplopProduzidaEmpregado').html('<b>'+ item.QT_UPOP_PRODUZIDA_EMPREGADO_G2.replace('.',',') +'</b>')
                        $('#totalLapLiquida').html('<b>'+ item.LAP_LIQUIDA_G2.replace('.',',') +'</b>')
                    }
                })
        })/*.done(function() {
        var linhasDatatable = item.PRODUTIVIDADE;
        
        if (linhasDatatable == NULL ){
            $("#cardTabela").css("display", "none");
            $("#cardExplicacao").css("display", "block");
        }else{
            $("#cardExplicacao").css("display", "none");
            $("#cardTabela").css("display", "block");
        }
        })*/
    })


    $.getJSON('/produtividade-vilop/api/relatorio-cards/'+unidade, function(dados){
        $.each(dados, function(key, item) {
            
            $('#desempenhoUnidade').html('<b>'+item.DESEMPENHO.replace('.',',')+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#pessoasUnidade').html('<b>'+item.PESSOAS.replace('.',',')+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#fteUnidade').html('<b>'+item.FTE_APURADA.replace('.',',')+'</b> <sup style="font-size: 20px">%</sup>' )
            $('#lapUnidade').html('<b>'+parseInt(item.LAP_UNIDADE)+'</b>')

            $('#fteApuradaMensuravel').html('<b>'+ item.FTE_APURADA_MENSURAVEL_G1.replace('.',',') +'</b> <sup style="font-size: 20px">%</sup>')
            $('#fteTecnicaMensuravel').html('<b>'+ item.FTE_TECNICA_MENSURAVEL_G1.replace('.',',') +'</b>')
            $('#fteNaoMensuravel').html('<b>'+ item.FTE_NAO_MENSURAVEL_G1.replace('.',',') +'</b>')
            $('#fteGestores').html('<b>'+ parseInt(item.GESTOTES) +'</b>')
            $('#fteAfastados').html('<b>'+ parseInt(item.AFASTADOS) +'</b>')

        })
    })

    $.getJSON('/produtividade-vilop/api/relatorio-macro/'+unidade, function(dados){
        $.each(dados, function(key, item) {
            var valueVolumeTotalMes = item.volumeTotalMes
            var valVolumeTotalMes = Number(valueVolumeTotalMes)
            var valorVolumeTotalMes = valVolumeTotalMes.toLocaleString('pt-BR');

            var valueVolumeRealizadoMes = item.VolumeRealizadoMes
            var valVolumeRealizadoMes = Number(valueVolumeRealizadoMes)
            var valorVolumeRealizadoMes = valVolumeRealizadoMes.toLocaleString('pt-BR');       

        var montaCard = `
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-start" style="color: #004c8c">
                        <h4 style="font-size:18px;"><b>Macroprocesso:</b>&nbsp&nbsp<span class="macro" id="macroprocesso_nome${item.ID_MACRO}">${item.DE_MACRO}</span></h4> 
                    </div>
                
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="primeiraTabela${item.ID_MACRO}" class="table table-super-condensed table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="colunaNormal"data-toggle="tooltip" title="Volumetria total recebida no mês">Volume total<br><small class="text-muted">mês</small></th>

                                        <th class="colunaNormal" data-toggle="tooltip" title="Volumetria tratada no mês">Volume realizado<br><small class="text-muted">mês</small></th>

                                        <th class="colunaNormal" data-toggle="tooltip" title="Média dos minutos para realizar volumetria tratada">Tempo médio realizado<br><small class="text-muted">minutos</small></th>

                                        <th class="colunaNormal" data-toggle="tooltip" title="Qtdade de horas para realizar o volume tratado">Horas alocadas<br><small class="text-muted">qtdade</small></th>

                                        <th class="colunaDiferenciada" data-toggle="tooltip" title="Volume Realizado / Volume Total">Desempenho<br><small class="text-muted">%</small></th>

                                        <th class="colunaDiferenciada" data-toggle="tooltip" title="% para realizar o estoque ou de sobrecarga">Pessoas<br><small class="text-muted">%</small></th>

                                        <th class="colunaDiferenciada" data-toggle="tooltip" title="% de ref. do microprocesso sobre UPLop Base">UPLop Base<br><small class="text-muted">%</small></th>

                                        <th class="colunaDiferenciada" data-toggle="tooltip" title="UPLop Devida considerando as Horas Alocadas">UPLop Devida<br><small class="text-muted">qtdade</small></th>

                                        <th class="colunaDiferenciada" data-toggle="tooltip" title="UPLop Produzida ponderando volumetria e tempo médio">UPLop Produzida<br><small class="text-muted">qtdade</small></th>

                                        <th class="colunaDiferenciada" data-toggle="tooltip" title="Relação entre UPLop Produzida pela UPLop Devida">Produtividade<br><small class="text-muted">%</small></th>

                                        <th class="colunaNormal" data-toggle="tooltip" title="Horas necessárias considerando o tempo médio">Horas necessárias<br><small class="text-muted">qtdade</small></th>

                                        <th class="colunaNormal" data-toggle="tooltip" title="Tempo médio estimado para realização do estoque">Tempo médio necessário<br><small class="text-muted">qtdade</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="totMacro${item.ID_MACRO}" class="atendimentos">
                                        <td class="estiloTotal"><a class="btn btn-link text-center font-weight-bold align-middle" data-toggle="collapse" href=".collapse${item.ID_MACRO}" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size:14px;">
                                            Total</a>
                                        </td>
                                        <td class="align-middle">${valorVolumeTotalMes}</td>
                                        <td class="align-middle">${valorVolumeRealizadoMes}</td>
                                        <td class="align-middle">${item.tempoMedioRealizado.replace('.',',')}</td>
                                        <td class="align-middle">${item.horasAlocadas.replace('.',',')}</td>
                                        <td class="colunaDiferenciada align-middle">${item.desempenho.replace('.',',')}</td>
                                        <td class="colunaDiferenciada align-middle">${item.pessoas.replace('.',',')}</td>
                                        <td class="colunaDiferenciada align-middle">${item.uplopBase.replace('.',',')}</td>
                                        <td class="colunaDiferenciada align-middle">${item.uplopDevida.replace('.',',')}</td>
                                        <td class="colunaDiferenciada align-middle">${item.uplopProduzida.replace('.',',')}</td>
                                        <td class="colunaDiferenciada align-middle">${item.produtividadeUplop.replace('.',',')}</td>
                                        <td class="align-middle">${item.horaExtraNecessaria.replace('.',',')}</td>
                                        <td class="align-middle">${item.tempoMedioNecessario.replace('.',',')}</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                `   
        $(montaCard).appendTo('#principal');

        })
        }).done(function() {
            $.getJSON('/produtividade-vilop/api/relatorio-micro/'+unidade, function(dados){
            $.each(dados, function(key, item) { 

                var valueVolumeTotalMes = item.volumeTotalMes
                var valVolumeTotalMes = Number(valueVolumeTotalMes)
                var valorVolumeTotalMes = valVolumeTotalMes.toLocaleString('pt-BR');

                var valueVolumeRealizadoMes = item.VolumeRealizadoMes
                var valVolumeRealizadoMes = Number(valueVolumeRealizadoMes)
                var valorVolumeRealizadoMes = valVolumeRealizadoMes.toLocaleString('pt-BR');

                var valueuplopDevida = item.uplopDevida
                var valuplopDevida = Number(valueuplopDevida)
                var valorUplopDevida = valuplopDevida.toLocaleString('pt-BR');

                var montaTabela = `
                    <tr class="atendimentos collapse collapse${item.ID_MACRO}">
                        <td  class="tituloMicro text-justify align-middle" style="max-width: 300px;">
                                <b>${item.DE_MICRO}</b>
                        </td>
                        <td class="align-middle">${valorVolumeTotalMes}</td>
                        <td class="align-middle">${valorVolumeRealizadoMes}</td>
                        <td class="align-middle">${item.tempoMedioRealizado.replace('.',',')}</td>
                        <td class="align-middle">${item.horasAlocadas.replace('.',',')}</td>
                        <td class="colunaDiferenciada align-middle">${item.desempenho.replace('.',',')}</td>
                        <td class="colunaDiferenciada align-middle">${item.pessoas.replace('.',',')}</td>
                        <td class="colunaDiferenciada align-middle">${item.uplopBase.replace('.',',')}</td>
                        <td class="colunaDiferenciada align-middle">${valorUplopDevida}</td>
                        <td class="colunaDiferenciada align-middle">${item.uplopProduzida.replace('.',',')}</td>
                        <td class="colunaDiferenciada align-middle">${item.produtividadeUplop.replace('.',',')}</td>
                        <td class="align-middle">${item.horaExtraNecessaria.replace('.',',')}</td>
                        <td class="align-middle">${item.tempoMedioNecessario.replace('.',',')}</td>
                    </tr> 
                    `
                $(montaTabela).appendTo(`#primeiraTabela${item.ID_MACRO}>tbody`);
            })
        })
    })


    var TotalNaoMensuravel = 0;
    $.getJSON('/produtividade-vilop/api/relatorio-nao-mensuraveis/'+unidade, function(dados){
        $.each(dados, function(key, item) {

            if (TotalNaoMensuravel == 0){
                let cardNaoMensuravel = 
                `
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-start" style="color: #004c8c">
                                <h4 style="font-size:18px;"><b>Macroprocesso:</b>&nbsp&nbsp<span class="macro" id="macroprocesso_naoMensuravel">SUPORTE / ATIVIDADES NÃO MENSURÁVEIS</span></h4> 
                            </div>

                            <div class="table-responsive">
                                <table id="primeiraTabelaNaoMensuravel" class="table table-super-condensed table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="colunaNormal"data-toggle="tooltip" title="">Pessoas Alocadas<br><small class="text-muted">qtdade</small></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="totMacroNaoMensuravel" class="atendimentos">
                                            <td class="estiloTotal"><a class="btn btn-link text-center font-weight-bold align-middle" data-toggle="collapse" href=".collapseNaoMensuravel" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size:14px;">
                                                Total</a>
                                            </td>
                                            <td class="align-middle"><span id="totalNaoMensuravel"></span></td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                `
                $(cardNaoMensuravel).appendTo('#principal');
            }

            var qtdadePessoas = item.QTDE_PESSOAS_ALOCADAS
            var QtdadePessoas = parseFloat(qtdadePessoas)
            var qtPessoas = qtdadePessoas        
            TotalNaoMensuravel = TotalNaoMensuravel + QtdadePessoas

            var montaTabelaNaoMensuravel = `
                <tr class="atendimentos collapse collapseNaoMensuravel">
                    <td  class="tituloMicro text-justify align-middle" style="max-width: 300px;">
                            <b>${item.DE_MICRO}</b>
                    </td>
                    <td class="align-middle">${item.QTDE_PESSOAS_ALOCADAS.replace('.',',')}</td>
                </tr> 
                `
            $(montaTabelaNaoMensuravel).appendTo(`#primeiraTabelaNaoMensuravel>tbody`);
        
            var somaNaoMensuravel = TotalNaoMensuravel
            $('#totalNaoMensuravel').html('<b>' + somaNaoMensuravel.toFixed(2).replace('.',',') + '</b>')

        })
    })
})


</script>

<script src="{{ asset('js/global/formata-data-datable.js') }}"></script>

@endsection
