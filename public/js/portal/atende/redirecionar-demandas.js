$(document).ready(function(){  
    $.getJSON('/gerencial/gestao-equipes/listar-empregados-equipe/20', function(dados){
        $.each(dados, function(key, item) {

            var linha =
                        '<option value="'+item.matricula+'">'+item.nomeCompleto+'</option>'

        $(linha).appendTo('#selectDestinatario');
        

        })
    })
})


