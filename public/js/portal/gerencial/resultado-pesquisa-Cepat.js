function _formataDatatableNovos (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 2, "desc" ]],
        "language": {
            "decimal": ",",
            "thousands": ".",
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
};

$(document).ready(function(){
    let linha =
    `
        <tr>
            <td>Administração dos imóveis do PAR - Aspectos físicos PAR</td>
            <td>C061649 - SOLANGE PEDRO - 14 votos</td>
            <td>C040644 - ANTONIO SARAIVA - 4 votos</td>
            <td>C059653 - SANDRA DAS DORES - 3 votos</td>
            <td></td>
        </tr>  
        <tr>
            <td>Administração dos imóveis do PAR - Pagamentos PAR</td>
            <td>C052847 - CARLOS SARREA - 10 votos</td>
            <td>C050505 - CELSO WATANABE - 6 votos</td>
            <td>C109636 - PATRICIA PEREIRA - 3 votos</td>
            <td>C099532 - SELMER GRILLO - 3 votos</td>
        </tr>
        <tr>
            <td>Administração dos imóveis do PAR - Demanda judicial PAR</td>
            <td>C090681 - MARISA GUERREIRO  - 9 votos</td>
            <td>C074575 - Ana Julia Chiaradia - 8 votos</td>
            <td>C040644 - ANTONIO SARAIVA - 3 votos</td>
            <td>C086588 - RODRIGO ANGELO - 3 votos</td>
        </tr>
        <tr>
            <td>Administração dos imóveis do PAR - Desligamento das unidades do PAR</td>
            <td>C136667 - Rosilene Golembiewski - 9 votos</td>
            <td>C052847 - Carlos Eduardo Sarrea - 5 votos</td>
            <td>C070113 - Alexandre Ricardo Miranda - 4 votos</td>
            <td>C038350 - Maristela de Athayde - 3 votos</td>
        </tr>
        <tr>
            <td>Administração de Contratos de Arrendamento - Manutenção de contratos individuais de Arrendamento Residencial</td>
            <td>C078433 - Adriana Reges - 8 votos</td>
            <td>C130343 - Katia da Rocha Rodrigues - 4 votos</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Gestão de Condomínios do PAR - Administração de condomínio do PAR não migrado</td>
            <td>C052847 - Carlos Eduardo Sarrea - 7 votos</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Gestão de Condomínios do PAR - Administração de condomínio do PAR migrado</td>
            <td>C052847 - Carlos Eduardo Sarrea - 3 votos</td>
            <td>C086588 - Rodrigo Angelo Souza - 3 votos</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Gestão de empresas para administração do PAR - Contratação de Empresas para gestão dos imóveis do PAR</td>
            <td>C052124 - Sylvia Tojar - 10 votos</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Gestão de empresas para administração do PAR - Gestão dos contratos de empresas administradoras do PAR</td>
            <td>C052847 - Carlos Eduardo Sarrea - 10 votos</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Tratamento de Bens Móveis - Administração de bens móveis não de uso</td>
            <td>c076585 - Vanessa Melleiro de Castro Janini - 6 votos</td>
            <td>C086588 - Rodrigo Angelo Souza - 4 votos</td>
            <td>c080853 - Isaac Jose Benzecry - 3 votos</td>
            <td></td>
        </tr>
        <tr>
            <td>Tratamento de Bens Móveis - Alienação de bens móveis não de uso</td>
            <td>C076585 - Vanessa Melleiro de Castro - 8 votos</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Tratamento do Penhor - Alienação das Garantias do Penhor</td>
            <td>C095043 - Luiz Francisco do Nascimento - 11 votos</td>
            <td>C130343 - Katia da Rocha Rodrigues - 4 votos</td>
            <td>c080853 - Isaac Jose Benzecry - 3 votos</td>
            <td></td>
        </tr>
        <tr>
            <td>Alienação de Veículos, máquinas e equipamentos</td>
            <td>C076585 - Vanessa Melleiro de Castro - 3 votos</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Programação, Desenvolvimento e Manutenção de Sistemas</td>
            <td>c098453 - Rafael Pimentel Gonçalves - 13 votos</td>
            <td>c064598 - Anderson Jones Silva - 3 votos</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Agente de RH / Administrativo / Compliance / Pronto Pagamento</td>
            <td>cC082403 - Carla Macedo de Mello - 7 votos</td>
            <td>C066517 - Renata D Oliveira Sallum - 5 votos</td>
            <td></td>
            <td></td>
        </tr>
                        
    `
    $(linha).appendTo('#tblResultado>tbody');
})

function mudaInfoParDanos() {
    if($('#listagemParDanos').text() == "Mais informações"){
      $('#listagemParDanos').text("Ocultar");
    }else{
      $('#listagemParDanos').text("Mais informações")
    }
  }
  
  function mudaInfoParAdm() {
    if($('#listagemParAdm').text() == "Mais informações"){
      $('#listagemParAdm').text("Ocultar");
    }else{
      $('#listagemParAdm').text("Mais informações")
    }
  }
        
  function mudaInfoParAlienar() {
    if($('#listagemParAlienar').text() == "Mais informações"){
      $('#listagemParAlienar').text("Ocultar");
    }else{
      $('#listagemParAlienar').text("Mais informações")
    }
  }
  
  function mudaInfoBensMoveis() {
    if($('#listagemBensMoveis').text() == "Mais informações"){
      $('#listagemBensMoveis').text("Ocultar");
    }else{
      $('#listagemBensMoveis').text("Mais informações")
    }
  }

  function mudaInfoInovacao() {
    if($('#listagemInovacao').text() == "Mais informações"){
      $('#listagemInovacao').text("Ocultar");
    }else{
      $('#listagemInovacao').text("Mais informações")
    }
  }