
$(document).ready(function(){ 
        carregar_atividades('selectEquipe')
        function carregar_atividades(id, equipe_id){
            var html = " "
            
            $.getJSON('/atende/listar-equipes-atividades-atende', function(dados){
                $.each(dados, function(key, item){
                html += '<option value="'+item.idEquipe+'">'+item.nomeEquipe+'</option>'
                })
                $('#'+id).html(html)
            })        
        }
        $(document).on('change', '#selectEquipe', function(){
            var equipe_id = $(this).val()
            console.log(equipe_id)

        })
    })
