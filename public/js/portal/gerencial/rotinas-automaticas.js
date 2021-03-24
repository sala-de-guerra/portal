$(document).ready(function(){
 
        let linha =
    `
        <tr>
            <td>Atualização Portal</td>
            <td>01/03/2021</td> 
            <td><span class="badge badge-success">Atualizado</span></td>
            <td> </td>
            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalObsRotina">
                <i class="far fa-edit"></i></button></td>
        </tr>  
        <tr>
            <td>Atualização Leilão Negativo</td>
            <td>01/03/2021</td> 
            <td><span class="badge badge-danger">Erro na Atualização</span></td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Atualização Laudo</td>
            <td>04/01/2021</td> 
            <td><span class="badge badge-warning">Pendente</span> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Atualização Planilha Suban</td>
            <td>04/01/2021</td> 
            <td><span class="badge badge-info">Outra info</span></td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Atualização TMA Vladimir - Script Siopi Request</td>
            <td>04/01/2021</td> 
            <td><span class="badge badge-info">Outra info</span></td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Envio e-mail contratação boletos NOVOS</td>
            <td>04/01/2021</td> 
            <td><span class="badge badge-info">Outra info</span></td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Envio Mensageria Contratação - todas as Gilies 
            <!-- https://portal.gilie.sp.caixa/contratacao/controle-boletos/envia-mensageria -->
            </td>
            <td>04/01/2021</td> 
            <td><span class="badge badge-info">Outra info</span></td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Envio Mensageria dos Corretores pré-habilitados para giliesp01
            <!-- https://portal.gilie.sp.caixa/corretores/envia-email-venda-prehabilitado -->
            </td>
            <td>04/01/2021</td> 
            <td><span class="badge badge-info">Outra info</span></td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td>Baixa propostas com indícios de fraude</td>
            <td>04/01/2021</td> 
            <td><span class="badge badge-info">Outra info</span></td>
            <td> </td>
            <td> </td>
        </tr>
                        
    `
    $(linha).appendTo('#tblRotinas>tbody');
        

});
