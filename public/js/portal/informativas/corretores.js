function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 0, "asc" ]],
        "pageLength": 25,
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

$('#selectGILIE').change(function(){
    if ($(this).val() === "7257") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblSP').css('display', 'block');
        $.getJSON('corretores/lista-corretores', function(dados){
            $.each(dados, function(key, item) {
                let linha =
                    `<tr>
                        <td>${item.CORRETOR}</td>
                        <td>${item.CRECI}</td>
                        <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                        <td>${item.EMAIL}</td>
                        <td>${item.VENCIMENTO}</td>
                    </tr>`
                        $(linha).appendTo('#tblCorretores>tbody');

                        if($('#telefone' + item.CRECI).text() == "(null) null" ||
                        $('#telefone' + item.CRECI).text() == "(Null) Null"){
                        $('#telefone' + item.CRECI).text("")
                    }
                    
            });
            _formataDatatableComData("tblCorretores")
            $('.spinnerTbl').remove()
            $('#tblCorretores').attr('id', 'tblCorretoresPopulada');
        });
    }else if ($(this).val() === "7255") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'block');
        $.getJSON('corretores/lista-corretores-sa', function(dados){
            $.each(dados, function(key, item) {
                let linha =
                    `<tr>
                        <td>${item.CORRETOR}</td>
                        <td>${item.CRECI}</td>
                        <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                        <td>${item.EMAIL}</td>
                        <td>${item.VENCIMENTO}</td>
                    </tr>`
                        $(linha).appendTo('#tblCorretoresSA>tbody');

                        if($('#telefone' + item.CRECI).text() == "(null) null" ||
                        $('#telefone' + item.CRECI).text() == "(Null) Null"){
                        $('#telefone' + item.CRECI).text("")
                    }
                    
            });
            _formataDatatableComData("tblCorretoresSA")
            $('.spinnerTblSA').remove()
            $('#tblCorretoresSA').attr('id', 'tblCorretoresSAPopulada');
        });
    }else if ($(this).val() === "7253") {
         $('#tblBH').css('display', 'none');
         $('#tblBU').css('display', 'none');
         $('#tblBE').css('display', 'none');
         $('#tblBR').css('display', 'none');
         $('#tblCT').css('display', 'none');
         $('#tblFO').css('display', 'none');
         $('#tblGO').css('display', 'none');
         $('#tblPO').css('display', 'none');
         $('#tblRJ').css('display', 'none');
         $('#tblSP').css('display', 'none');
         $('#tblSA').css('display', 'none');
         $('#tblRE').css('display', 'block');
        $.getJSON('corretores/lista-corretores-re', function(dados){
            $.each(dados, function(key, item) {
                let linha =
                    `<tr>
                        <td>${item.CORRETOR}</td>
                        <td>${item.CRECI}</td>
                        <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                        <td>${item.EMAIL}</td>
                        <td>${item.VENCIMENTO}</td>
                    </tr>`
                        $(linha).appendTo('#tblCorretoresRE>tbody');

                        if($('#telefone' + item.CRECI).text() == "(null) null" ||
                        $('#telefone' + item.CRECI).text() == "(Null) Null"){
                        $('#telefone' + item.CRECI).text("")
                    }
                    
            });
            _formataDatatableComData("tblCorretoresRE")
            $('.spinnerTblRE').remove()
            $('#tblCorretoresRE').attr('id', 'tblCorretoresREPopulada');
        });
    }else if ($(this).val() === "7254") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'block');
       $.getJSON('corretores/lista-corretores-rj', function(dados){
           $.each(dados, function(key, item) {
               let linha =
                   `<tr>
                       <td>${item.CORRETOR}</td>
                       <td>${item.CRECI}</td>
                       <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresRJ>tbody');

                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   
           });
           _formataDatatableComData("tblCorretoresRJ")
           $('.spinnerTblRJ').remove()
           $('#tblCorretoresRJ').attr('id', 'tblCorretoresRJPopulada');
       });
    }else if ($(this).val() === "7251") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'block');
       $.getJSON('corretores/lista-corretores-po', function(dados){
           $.each(dados, function(key, item) {
               let linha =
                   `<tr>
                       <td>${item.CORRETOR}</td>
                       <td>${item.CRECI}</td>
                       <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresPO>tbody');

                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   
           });
           _formataDatatableComData("tblCorretoresPO")
           $('.spinnerTblPO').remove()
           $('#tblCorretoresPO').attr('id', 'tblCorretoresPOPopulada');
       });
    }else if ($(this).val() === "7249") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'block');
       $.getJSON('corretores/lista-corretores-go', function(dados){
           $.each(dados, function(key, item) {
               let linha =
                   `<tr>
                       <td>${item.CORRETOR}</td>
                       <td>${item.CRECI}</td>
                       <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresGO>tbody');

                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   
           });
           _formataDatatableComData("tblCorretoresGO")
           $('.spinnerTblGO').remove()
           $('#tblCorretoresGO').attr('id', 'tblCorretoresGOPopulada');
       });
    }else if ($(this).val() === "7248") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'block');
       $.getJSON('corretores/lista-corretores-fo', function(dados){
           $.each(dados, function(key, item) {
               let linha =
                   `<tr>
                       <td>${item.CORRETOR}</td>
                       <td>${item.CRECI}</td>
                       <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresFO>tbody');

                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   
           });
           _formataDatatableComData("tblCorretoresFO")
           $('.spinnerTblFO').remove()
           $('#tblCorretoresFO').attr('id', 'tblCorretoresFOPopulada');
       });
 }else if ($(this).val() === "7247") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'block');
       $.getJSON('corretores/lista-corretores-ct', function(dados){
           $.each(dados, function(key, item) {
               let linha =
                   `<tr>
                       <td>${item.CORRETOR}</td>
                       <td>${item.CRECI}</td>
                       <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresCT>tbody');

                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   
           });
           _formataDatatableComData("tblCorretoresCT")
           $('.spinnerTblCT').remove()
           $('#tblCorretoresCT').attr('id', 'tblCorretoresCTPopulada');
       });
    }else if ($(this).val() === "7109") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblBR').css('display', 'block');
       $.getJSON('corretores/lista-corretores-br', function(dados){
           $.each(dados, function(key, item) {
               let linha =
                   `<tr>
                       <td>${item.CORRETOR}</td>
                       <td>${item.CRECI}</td>
                       <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresBR>tbody');

                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   
           });
           _formataDatatableComData("tblCorretoresBR")
           $('.spinnerTblBR').remove()
           $('#tblCorretoresBR').attr('id', 'tblCorretoresBRPopulada');
       });
    }else if ($(this).val() === "7243") {
        $('#tblBH').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblBE').css('display', 'block');
       $.getJSON('corretores/lista-corretores-be', function(dados){
           $.each(dados, function(key, item) {
               let linha =
                   `<tr>
                       <td>${item.CORRETOR}</td>
                       <td>${item.CRECI}</td>
                       <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresBE>tbody');

                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   
           });
           _formataDatatableComData("tblCorretoresBE")
           $('.spinnerTblBE').remove()
           $('#tblCorretoresBE').attr('id', 'tblCorretoresBEPopulada');
       });
    }else if ($(this).val() === "7242") {
        $('#tblBH').css('display', 'none');
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBU').css('display', 'block');
       $.getJSON('corretores/lista-corretores-bu', function(dados){
           $.each(dados, function(key, item) {
               let linha =
                   `<tr>
                       <td>${item.CORRETOR}</td>
                       <td>${item.CRECI}</td>
                       <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresBU>tbody');

                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   
           });
           _formataDatatableComData("tblCorretoresBU")
           $('.spinnerTblBU').remove()
           $('#tblCorretoresBU').attr('id', 'tblCorretoresBUPopulada');
       });
    }else if ($(this).val() === "7244") {
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBH').css('display', 'block');
       $.getJSON('corretores/lista-corretores-bh', function(dados){
           $.each(dados, function(key, item) {
               let linha =
                   `<tr>
                       <td>${item.CORRETOR}</td>
                       <td>${item.CRECI}</td>
                       <td id="telefone${item.CRECI}">(${item.DDDCELULAR})`+" "+`${item.TELEFONECELULAR}</td>
                       <td>${item.EMAIL}</td>
                       <td>${item.VENCIMENTO}</td>
                   </tr>`
                       $(linha).appendTo('#tblCorretoresBH>tbody');

                       if($('#telefone' + item.CRECI).text() == "(null) null" ||
                       $('#telefone' + item.CRECI).text() == "(Null) Null"){
                       $('#telefone' + item.CRECI).text("")
                   }
                   
           });
           _formataDatatableComData("tblCorretoresBH")
           $('.spinnerTblBH').remove()
           $('#tblCorretoresBH').attr('id', 'tblCorretoresBHPopulada');
       });
    }else{
        $('#tblSP').css('display', 'none');
        $('#tblSA').css('display', 'none');
        $('#tblRE').css('display', 'none');
        $('#tblRJ').css('display', 'none');
        $('#tblPO').css('display', 'none');
        $('#tblGO').css('display', 'none');
        $('#tblFO').css('display', 'none');
        $('#tblCT').css('display', 'none');
        $('#tblBR').css('display', 'none');
        $('#tblBE').css('display', 'none');
        $('#tblBU').css('display', 'none');
        $('#tblBH').css('display', 'none');
   }
})

