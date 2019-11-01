var idTabelaDataTable = '';


//função para enviar dados para o banco
function enviarSolicitacao()
{
    //verifica a tabela ativa
    idTabelaDataTable = idTabela();
    
    //captura os dados para enviar para o banco
    try {
        ctr = {       
            contratoBndes : $("#contrato_bndes_editar").val(), 
            contaDebito : $("#conta_corrente_editar").val(), 
            valorOperacao : $("#valor_editar").val().replace(/[\.]/g, "").replace(",","."), 
            tipoOperacao : $("#tipo_editar").val(), 
            status : $("#status_editar").val(),       
            observacoes : $("#observacaoContrato").val(),    
            loteDataTable: $("#lote").val(),
        }
        

        //se o status for cancelado, atualiza a tabela de cadastro da demanda e a tabela ativa
        if ($("#status_editar").val() === 'CANCELADO') {
            $.ajax({       
                type: 'PUT',
                url : '../api/bndes/v2/siaf_amortizacoes/' + $("#codDemanda").val() ,
                context : this,
                data: ctr,
                success: function(ctr){
               
                    if(idTabelaDataTable == 'tabelaGestor'){
             
                        refreshTabelaGestor(ctr, idTabelaDataTable); 
                        
                    }else{
                        refreshTabela(ctr, idTabelaDataTable);
                        atualizaDataTableCadastroDemanda(); 
                        console.log('fim');
                    }
                }
            });
        
        } else{
            $.ajax({       
                type: 'PUT',
                url : '../api/bndes/v2/siaf_amortizacoes/' + $("#codDemanda").val() ,
                context : this,
                data: ctr,
                success: function(ctr){
                         // se o status for diferente de cancelado atualiza a tabela ativa    
                         if(idTabelaDataTable == 'tabelaGestor'){
             
                            refreshTabelaGestor(ctr, idTabelaDataTable); 
                            
                        }
                        else{
                            refreshTabela(ctr, idTabelaDataTable); 
                        }
                  
                }
            });
        }
        console.log(ctr);
    //retorna o erro    
    } catch(Error) {
        console.log(Error);   
    }
}