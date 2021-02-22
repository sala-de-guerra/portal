@extends('portal.produtividade-cepat.template')
@extends('portal.produtividade-cepat.componentes.menu-lateral')


@section('saudacao')
    <p class="col-lg-12 callout callout-info">
     Nesta página estão listadas em tempo real as unidades que estão respondendo ao questionário proposto pelo GT
    </p>
    
@endsection


@section('conteudo')
</div>

<div class="row"> <!-- /.card-unidades -->
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title callout callout-info mt-1">
                    <p>Total unidades:  <span id="totalUnidades"></span></p>
                </h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <table id="listaUnidades" class="table table-bordered table-striped dataTable">
                    <thead>
                        <tr>
                            <th>CGC - SIGLA</th>
                            <th>NOME UNIDADE</th>
                            <th style="text-align:center;">PLANILHA </th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>               
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->  
</div> <!-- /.row -->

</div>
@endsection

@section('js')

<script>

function _formataDatatableComData (idTabela){
    $('#' + idTabela).DataTable({
        //"order": [[ 3, "asc" ]],     
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

var totalUnidades = 0
$.getJSON('/produtividade-cepat/unidades-macro-cadastrada/lista', function(dados){
    $.each(dados, function(key, item) { 
        let lista = `
        <tr>
            <td>
                <a href="/produtividade-cepat/${item.CGC_UNIDADE}" class="cursor-pointer">${item.CGC_UNIDADE} - ${item.Sigla} </a>
            </td>
            <td>
                <a href="/produtividade-cepat/${item.CGC_UNIDADE}" class="cursor-pointer">${item.NOME_UNIDADE}</a>
            </td>
            <td style="text-align:center;">
                <span> 
                    <a href="/produtividade-cepat/excel/planilha-cepat-geral/${item.CGC_UNIDADE}">
                        <button
                        type="button" 
                        class="btn btn-success">
                        Baixar a Planilha Respostas da unidade <i class="fas fa-file-excel"></i></button></a>
                </span>
            </td>
        </tr>
        `
        totalUnidades+=1
        $(lista).appendTo('#listaUnidades');
    })
}).done(function() {
        $('#totalUnidades').text(totalUnidades);
        _formataDatatableComData("listaUnidades")
    })

</script>

<script src="{{ asset('js/global/formata-data-datable.js') }}"></script>

@endsection