var unidade = $('#unidade').text()
unidade = unidade.trim();
var csrfVarVilop = $('#tokenVilop').val();

var lista = []

function sortUL(selector) {
  var $ul = $(selector);
  $ul.find('li').sort(function(a, b) {
    var upA = $(a).text().toUpperCase();
    var upB = $(b).text().toUpperCase();
    return (upA < upB) ? -1 : (upA > upB) ? 1 : 0;
  }).appendTo(selector);
};

$(document).ready(function(){
    
    $.getJSON('/produtividade-vilop/lista-macro-processo/' + unidade, function(dados){
        $.each(dados, function(key, item) {
            var linha =  
            `
                <tr>
                    <td>${item.nomeMacroAtividade}</td>
                    <td></td>
                    <td> 
                        <form class="was-validated">                        
                            <div class="form-group">
                                <select class="custom-select" required>
                                    <option value="">Escolha</option>
                                    <option value="1">Não</option>
                                    <option value="2">Sim</option>
                                </select>
                                <div class="invalid-feedback">Escolha SIM ou NÃO</div>
                            </div>
                        </form>
                    </td>
                </tr>
            `
            $(linha).appendTo('#tblPesquisaProdutividadeVilop>tbody');
            lista.push(item.idMacro);  
        })
    }).done(function() {
        $.getJSON('/produtividade-vilop/lista-micro-processo/' + unidade, function(dados){
            $.each(dados, function(key, item) {
                var micro = item.nomeMicroatividade
                `
                <li>
                
                </li>

                `
            
                $(micro).appendTo('#menu-' + item.idMacro);
            })  
        })
    }).done(function() {
        
        lista.forEach(function(valor, chave){
            sortUL('#menu-'+valor);
        });
    })
})

