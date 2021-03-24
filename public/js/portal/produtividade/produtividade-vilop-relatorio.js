function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        "order": [[ 3, "desc" ]],     
        "pageLength": 10,
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

/*
$(document).ready(function(){
    $(".menu-hamburguer").click();

    let linhaGeral =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,15</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,83</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,10</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,03</td>
    </tr>                          

    `
    $(linhaGeral).appendTo('#tblResultadoMacroprocesso>tbody');

    let linhaAutomatizado =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,15</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,83</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,10</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,03</td>
    </tr>                          

    `
    $(linhaAutomatizado).appendTo('#tblResultadoAutomatizado>tbody');

    let linhaMicroAutomatizado =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>                          

    `
    $(linhaMicroAutomatizado).appendTo('#tblResultadoMicroAutomatizado>tbody');

    let linhaComplexo =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,15</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,83</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,10</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,03</td>
    </tr>                          

    `
    $(linhaComplexo).appendTo('#tblResultadoComplexos>tbody');


    let linhaMicroComplexo =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>                          

    `
    $(linhaMicroComplexo).appendTo('#tblResultadoMicroComplexos>tbody');

    let linhaManual =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,15</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,83</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,10</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,03</td>
    </tr>                          

    `
    $(linhaManual).appendTo('#tblResultadosManuais>tbody');

    let linhaMicroManual =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>                          

    `
    $(linhaMicroManual).appendTo('#tblResultadoMicroManuais>tbody');

    let linhaSecundario =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,15</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,83</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,10</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,03</td>
    </tr>                          

    `
    $(linhaSecundario).appendTo('#tblResultadosSecundarios>tbody');

    let linhaMicroSecundario =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>                          
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    `
    $(linhaMicroSecundario).appendTo('#tblResultadoMicroSecundarios>tbody');

    $('#botaoAbrirListagem').click(function(){
        $('#icone').toggleClass('fas fa-angle-double-up fas fa-angle-double-down');
    });

    $('#botaoMicroAuto').click(function(){
        $('#iconeMicroAuto').toggleClass('fa fa-angle-up fa fa-angle-down');
    });

    $('#botaoMicroComplexo').click(function(){
        $('#iconeMicroComplexo').toggleClass('fa fa-angle-up fa fa-angle-down');
    });
     
    $('#botaoMicroManuais').click(function(){
        $('#iconeMicroManuais').toggleClass('fa fa-angle-up fa fa-angle-down');
    });

    $('#botaoMicroSecundarios').click(function(){
        $('#iconeMicroSecundarios').toggleClass('fa fa-angle-up fa fa-angle-down');
    });

    let linhaGeral1 =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,15</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,83</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,10</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,03</td>
    </tr>                          

    `
    $(linhaGeral1).appendTo('#tblResultadoMacroprocesso1>tbody');

    let linhaAutomatizado1 =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,15</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,83</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,10</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,03</td>
    </tr>                          

    `
    $(linhaAutomatizado1).appendTo('#tblResultadoAutomatizado1>tbody');

    let linhaMicroAutomatizado1 =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>                          

    `
    $(linhaMicroAutomatizado1).appendTo('#tblResultadoMicroAutomatizado1>tbody');

    let linhaComplexo1 =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,15</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,83</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,10</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,03</td>
    </tr>                          

    `
    $(linhaComplexo1).appendTo('#tblResultadoComplexos1>tbody');


    let linhaMicroComplexo1 =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>                          

    `
    $(linhaMicroComplexo1).appendTo('#tblResultadoMicroComplexos1>tbody');

    let linhaManual1 =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,15</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,83</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,10</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,03</td>
    </tr>                          

    `
    $(linhaManual1).appendTo('#tblResultadosManuais1>tbody');

    let linhaMicroManual1 =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>                          

    `
    $(linhaMicroManual1).appendTo('#tblResultadoMicroManuais1>tbody');

    let linhaSecundario1 =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,15</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,83</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,20</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,10</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,03</td>
    </tr>                          

    `
    $(linhaSecundario1).appendTo('#tblResultadosSecundarios1>tbody');

    let linhaMicroSecundario1 =
    `
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>                          
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    <tr>
        <td class="align-middle" style="font-size:12px; text-align:center;">Orientação e atendimento aos peritos judiciais (via email)</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,50</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">1,00</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">4,17</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,24</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">0,62</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">-0,38</td>
        <td class="align-middle" style="font-size:12px; text-align:center;">30</td>
    </tr>
    `
    $(linhaMicroSecundario1).appendTo('#tblResultadoMicroSecundarios1>tbody');

    let linhaFTE =
    `
    <tr>
        <td class="align-middle" style="font-size:14px; text-align:center;">79</td>
        <td class="align-middle" style="font-size:14px; text-align:center;">72,18</td>
        <td class="align-middle" style="font-size:14px; text-align:center;">31,82</td>
        <td class="align-middle" style="font-size:14px; text-align:center;">12</td>
        <td class="align-middle" style="font-size:14px; text-align:center;">4</td>
    </tr>                          

    `
    $(linhaFTE).appendTo('#tblRelatorioFTE>tbody');


    $('#botaoAbrirListagem1').click(function(){
        $('#icone1').toggleClass('fas fa-angle-double-up fas fa-angle-double-down');
    });

    $('#botaoMicroAuto1').click(function(){
        $('#iconeMicroAuto1').toggleClass('fa fa-angle-up fa fa-angle-down');
    });

    $('#botaoMicroComplexo1').click(function(){
        $('#iconeMicroComplexo1').toggleClass('fa fa-angle-up fa fa-angle-down');
    });
     
    $('#botaoMicroManuais1').click(function(){
        $('#iconeMicroManuais1').toggleClass('fa fa-angle-up fa fa-angle-down');
    });

    $('#botaoMicroSecundarios1').click(function(){
        $('#iconeMicroSecundarios1').toggleClass('fa fa-angle-up fa fa-angle-down');
    });
    
    $('#listagemFTE').click(function(){
        $('#iconeFTE').toggleClass('fa fa-angle-up fa fa-angle-down');
    });
    
});

*/




$('#listagemFTE').click(function(){
    $('#iconeFTE').toggleClass('fa fa-angle-up fa fa-angle-down');
});

$(document).ready(function(){
    $(".menu-hamburguer").click();

    $('tr').hover(function(event){
        $(this).css("background", "#b3c7cb");
    }, function() {
        $(this).css("background", "white");
    })

   //$('.atendimentos').click(function(){
     //  $(this).find('span').text(function(_, value){return value=='-'?'+':'-'});
       // $(this).nextUntil('tr.atendimentos').slideToggle(100, function(){
       // });
    // });

    


    $('h2').hover(function(event){
        $($(this).find("span")[0]).show();
        $(this).css("background", "#ec7500");
    }, function() {
        $($(this).find("span")[0]).hide();
        $(this).css("background", "#f39200");
    })


});


$( "#totMacro" ).click(function() {
    $( ".ativ" ).toggle( "slow", function() {
        $("#totMacro").find('span').text(function(_, value){return value=='-'?'+':'-'});
    });
});

$( "#atividadeVolumosa" ).click(function() {
    $( ".microVol" ).toggle( "slow", function() {
        $("#atividadeVolumosa").find('span').text(function(_, value){return value=='-'?'+':'-'});
    });
});