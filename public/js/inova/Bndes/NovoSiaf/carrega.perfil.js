$(document).ready(function() {
    carregaDadosEmpregado();
});

//  carrega os dados da pessoa logada na sessão
function carregaDadosEmpregado(json) {
    var url = ('../api/sistemas/v1/dados_empregado');
    
    $.ajax({
        type: 'GET',
        url : url,
        success: function(carregaEmpregado) {
            var empregado = JSON.parse(carregaEmpregado);
            $.each(empregado, function(key, value) {
                // verificao perfil e desabilita a aba da agência caso perfil CEOPC
                if(!!value.codigoLotacaoFisica) {
                    $(".perfilVisualizacao").html('Pedidos da unidade : ' + value.nomeLotacaoFisica);
                    $("#nomeEmpregado").html(value.nomeCompleto);
                    $("#nomeSessao").html(value.nomeCompleto);
                    $("#matriculaSessao").html(value.matricula);
                    $("#funcaoSessao").html(value.nomeFuncao);
                    $("#lotacaoSessao").html(value.codigoLotacaoFisica);
                    $("#perfilSessao").html(value.nivelAcesso);  
                    $("#nomeSessaoBemVindo").html(value.nomeCompleto);  
                    $("#agenciaContrato").html(value.nomeLotacaoFisica);
                } else {
                    $(".perfilVisualizacao").html('Pedidos da unidade : ' + value.nomeLotacaoAdministrativa);
                    $("#nomeEmpregado").html(value.nomeCompleto);
                    $("#nomeSessao").html(value.nomeCompleto);
                    $("#matriculaSessao").html(value.matricula);
                    $("#funcaoSessao").html(value.nomeFuncao);
                    $("#lotacaoSessao").html(value.codigoLotacaoAdministrativa);
                    $("#perfilSessao").html(value.nivelAcesso);  
                    $("#nomeSessaoBemVindo").html(value.nomeCompleto);  
                    $("#agenciaContrato").html(value.nomeLotacaoAdministrativa);
                }
                    
                switch (value.nivelAcesso) {
                    case 'CEOPA':
                    case 'CEOPC':
                        $("#abaContratosLiquidar").hide();
                        $("#contratosliquidar").hide();
                        $("#abaContratosLiquidar").removeClass("active");
                        $("#abaLoteAtual").addClass("active").show(); 
                        $("#loteAtual").addClass("active").show();
                        $(".perfilVisualizacao").html('Visualizando Todos Pedidos');
                        $('#editarAg').remove();
                        break;

                    case 'EMPREGADO_AG':
                    case 'EMPREGADO_SR':
                    case 'EMPREGADO_MATRIZ':
                    case 'GIGAD':
                        $("#abaAmortizaTodas").hide();
                        $('#editarCEOPC').remove(); 
                        break;

                    case 'AUDITOR':
                        $(".perfilVisualizacao").html('Auditoria Visualizando Todos Pedidos');
                        $('#editarCEOPC').remove(); 
                        break;

                    case 'MASTER':
                        $(".perfilVisualizacao").html('MASTER: Visualizando Todos Pedidos');
                        break;
                    default:
                    console.log(Error);
                }
            });
        }
    });  
}