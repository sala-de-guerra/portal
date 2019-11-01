// quando o documento carrega chama a função que carrega os dados dos contratos 
$(document).ready(function(){
    carregarDadosAgencia();
});	

//token segurança do laravel
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// carrega tabela dos clientes da agência de acordo com o Perfil 
function carregarDadosAgencia(){
    $.getJSON('../api/bndes/v3/siaf_contratos', function(json){
        $.each(json, function (key, value){
            linha = atualizaTabelaAgencia(value);
            $('#tabelaContratosLiquidar>tbody').append(linha);
            idTabelaDataTable = "tabelaLoteAtual";
           
    });
    // transforma a tabela em data table
    $("#tabelaContratosLiquidar").DataTable();

    });
}

//função que monta a tabela com os clientes de acordo com o perfil
function atualizaTabelaAgencia(json){
    //destroy a table para criar uma nova com os dados
    bDestroy : true,	
    linha = '<tr>' +
                '<td>' + json.cliente	+ '</td>' +
                '<td>' + json.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5") + '</td>' +
                '<td>'	+				
                    '<button class="btn btn-info btn-xs tip visualiza icon-pencil3 center-block" id="botaoCadastrar" onclick ="visualizaContratoParaCadastrarDemanda(\'' + json.cnpj + '\')" ></button> ' + 
                '</td>' +              
            '</tr>';
    return linha;
}

// remove os dados do modal aberto anteriormente e inclui o da nova pesquisa   
jQuery('#modalCadastramento').on('hidden.bs.modal', function (e) {
    jQuery(this).removeData('#tabCadastrar>tbody');
    jQuery(this).find('textarea.co_observacoes').val('');
    jQuery(this).find('#tabCadastrar>tbody').empty();
//seleciona a aba selecionar contrato como primeira, mesmo após abrir e fechar o modal
$('#modalInstrucoes').removeClass("active");
$('#tabInstrucoes').removeClass("active");
$('#modalCadastrar').addClass("active").show();
$('#tabSelecionar').addClass("active in").show();
})

// carrega o modal com todos os contratos dos clientes por CNPJ para solicitar amortização
function visualizaContratoParaCadastrarDemanda(json){
 
    $.ajax({      
        type: 'GET',
        url : '../api/bndes/v1/siaf_contratos/' + json,     
        success: function(carregaContratos){         
            var contratos = JSON.parse(carregaContratos);
            var i = 0;
           
            $.each(contratos, function(key, value){
                //coloca os dados do cliente na parte de cima do modal
                $("#cnpj_cliente").html(value.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
                $("#nome_cliente").html(value.cliente);

                //verifica o tipo de contrato para escolher qual numero de contrato do BNDES mostrar
                if (value.operacao == '717') {                          
                    linhaCadastro = '<tr>' +                          
                                        '<td><input placeholder ="..." type="text" minlength ="11" maxlength ="11" pattern="[0-9].{10,10}" name="contratoBndes" class=" contratoBndes form-control" value="' + value.contratoBndes + '" id="ctrBndes' + [i] +'"/></td>' +
                                        '<td><input placeholder ="..." type="text" name="contratoCaixa" class="contratoCaixa form-control" value="' + value.contratoCaixa + '" id="ctrCaixa' + [i] +'"/readonly></td>' +
                                        '<td><input placeholder ="..." type="text" name="conta" class="conta form-control" value="' + value.contaDebito	+ '"id="contaDebito' + [i] +'"/></td>' +
                                        '<td><input type="text" placeholder="Informe o valor" name="valorAmortizacao" class="valorAmortizacao dinheiro form-control" id="valorAmort' + [i] +'" /></td>' +
                                        '<td><select id="tipoAmort' + [i] +'" name="tipoAmortizacao"  class=" tipoAmortizacao form-control"><option disabled selected value>Selecione o tipo:</option> <option value="A">Amortização</option> <option value="L">Liquidação</option> </select></td>' +                                      
                                    '</tr>';
                } else {
                    linhaCadastro = '<tr>' +
                                        '<td><input placeholder ="..." type="text" minlength ="11" maxlength ="11" pattern="[0-9].{10,10}" name="contratoBndes"  class=" contratoBndes form-control" value="' + value.contratoBndesFiname + '" id="ctrBndes' +[i] +'"/></td>' +
                                        '<td><input placeholder ="..." type="text" name="contratoCaixa" class="contratoCaixa form-control" value="' + value.contratoCaixa + '" id="ctrCaixa' +[i] +'"/readonly></td>' +
                                        '<td><input placeholder ="..." type="text" name="conta" class="conta form-control" value="' + value.contaDebito	+ '"id="contaDebito' + [i] +'"/></td>' +
                                        '<td><input type="text" placeholder="Informe o valor" name="valorAmortizacao"  class="valorAmortizacao dinheiro form-control"  id="valorAmort' + [i] +'" /></td>' +
                                        '<td><select id="tipoAmort' + [i] +'" name="tipoAmortizacao"  class=" tipoAmortizacao form-control"><option disabled selected value>Selecione o tipo:</option> <option value="A">Amortização</option> <option value="L">Liquidação</option> </select></td>' +                   
                                    '</tr>';
                }
                //adiciona linha ao modal
                $('#tabCadastrar>tbody').append(linhaCadastro);
                //coloca mascara de valor 
                $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
                
                //altera os contratos nulos para vazio
                if ($("#ctrBndes" +[i]).val() == 'null'){
                    $("#ctrBndes" +[i]).val('');
                   
               }
                i++;
            });
         
        }             
    });  
    $('#modalCadastramento').modal('show');
}   


$('.cadAmortizacao').click(function(){

    enviarSolicitacaoAmortizacao();

});

//chama a função que valida os campos a serem preenchidos quando clica no botão
function enviarSolicitacaoAmortizacao() {

    validaCadastroAmortizacao();
    
}

//enviar dados para o banco
$('#formulario_pedido_amortizacao').submit(function(event){
    event.preventDefault();
   
        var pedidos = $('#tabCadastrar>tbody>tr').length;
        var cadastro = []; 
        i=0;

        for(i; i < pedidos; i++) {
          
            if ($("#valorAmort"+[i]).val() !== '' ){
               
                var pedido = {
                    contratoBndes: $("#ctrBndes"+[i]).val(),
                    contratoCaixa: $("#ctrCaixa"+[i]).val(),
                    contaDebito: $("#contaDebito"+[i]).val(),
                    valorAmortizacao: $("#valorAmort"+[i]).val().replace(/[\.]/g, "").replace(",","."),
                    tipoComando: $("#tipoAmort"+[i]).val(),
                    observacoes: $("textarea.co_observacoes").val(),      
                }
                cadastro.push(pedido);
                console.log(pedido);
            } 
        }
        //tenta fazer o post
        try {
        $.ajax({
            method: 'POST',
            cache: false,
            url: '../api/bndes/v2/siaf_amortizacoes',
            data: {'data':cadastro},
            async: false,
            success: function (jsonStr) {
                refreshTabela(jsonStr, 'tabelaLoteAtual'); 
                // Destroi o DataTable de Contratos a Liquidar
                atualizaDataTableCadastroDemanda();

                $('#modalCadastramento').modal('hide');
                $('#confirmacao').modal('show');
            },
           //retorna se erro e não efetua o cadastro  
            error: function () {
                $('#modalErro').modal('show');
            }    
          
        });
        
        }
        finally{
        $('#modalCadastramento').modal('hide');
        }
});

//atualiza a tabela depois de cadastrar o contrato
function atualizaDataTableCadastroDemanda() {
    $("#tabelaContratosLiquidar").DataTable().fnDestroy();
    $("#tabelaContratosLiquidar").empty(); 

    let novaTable = document.createElement('thead');
    let novaTableTr = document.createElement('tr');

    let novaTableThTomador = document.createElement('th');
    let tituloTomador = document.createTextNode("Tomador");
    novaTableThTomador.appendChild(tituloTomador);
    novaTableTr.appendChild(novaTableThTomador);

    let novaTableThCnpj = document.createElement('th');
    let tituloCnpj = document.createTextNode("Cnpj");
    novaTableThCnpj.appendChild(tituloCnpj);
    novaTableTr.appendChild(novaTableThCnpj);

    let novaTableThAcao = document.createElement('th');
    let tituloAcao = document.createTextNode("Solicitar liquidação/amortização");
    novaTableThAcao.appendChild(tituloAcao);
    novaTableTr.appendChild(novaTableThAcao);

    let novaTableBody = document.createElement('tbody');

    novaTable.appendChild(novaTableTr);

    document.getElementById('tabelaContratosLiquidar').appendChild(novaTable);
    document.getElementById('tabelaContratosLiquidar').appendChild(novaTableBody);

    carregarDadosAgencia();
    $('#tabelaContratosLiquidar').css("width","100%"); 
}

 