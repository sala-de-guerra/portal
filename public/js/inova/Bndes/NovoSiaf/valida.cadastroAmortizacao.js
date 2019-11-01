 //função para validar os campo do formulário antes de efetuar o envio para o banco
 function validaCadastroAmortizacao(){
    var pedidos = $('#tabCadastrar>tbody>tr').length;
    i=0;
   
    
    for(i; i < pedidos; i++) {

        if ($("#valorAmort"+[i]).val() !== ""){

            $("#valorAmort"+[i]).attr("required", true);
            $("#contaDebito"+[i]).attr("required", true);
            $("#tipoAmort"+[i]).attr("required", true);
            $("#ctrBndes"+[i]).attr("required", true);

        
        }
         
        else{
            
            $("#valorAmort"+[i]).attr("required", false);
            $("#contaDebito"+[i]).attr("required", false);
            $("#tipoAmort"+[i]).attr("required", false);
            $("#ctrBndes"+[i]).attr("required", false);

       
        }

    }
 
}

   