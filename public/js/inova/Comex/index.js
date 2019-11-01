$('#tabelaEmail').DataTable({
   
    "language": {
        "search": "Pesquisar _INPUT_ ",
        "info": "Mostrando _PAGE_ a _PAGE_ de _PAGES_",
        "lengthMenu": "Mostrar _MENU_ entradas",
        "zeroRecords":    "Nenhum dado encontrado",

        "paginate": {
            "next": "Próximo",
            "previous": "Anterior"
        },
    },      
});

function visualizaModal(){
        
    $('#modalVisualizar').modal('show');
    
}

function editaModal(){

    $('#modalEditar').modal('show');

}

function historicoModal(){

    $('#modalHistórico').modal('show');

}