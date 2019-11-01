//verifica o id da tabela ativa
function idTabela(){

nomeBotao = $('#abasDasTabelas .active').attr('id');

switch(nomeBotao){
 
    case "abaLoteAtual":
    idTabelaDataTable = "tabelaLoteAtual";
    
    break;
    case "abaAmortizaant":
    idTabelaDataTable = "tabelaLoteAnterior";
    
    break;
    case "abaGestor":
    idTabelaDataTable = "tabelaGestor";
    
    break;
   
   
}
return idTabelaDataTable;

}
