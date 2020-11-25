<?php


namespace App\Http\Controllers\SAP;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\HistoricoPortalGilie;
use App\Classes\DiasUteisClass;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\criaExcelSAPGeral;

class sapController extends Controller
{
    public function indexSap()
    {
        return view('portal.sap.controle-sap');
    }
    
    public function listaUniversoSAP()
    {
        // $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $boletosAvista= DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
        ->leftjoin('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.NU_BEM',  "=", 'CUB_056_PAGAMENTOS_BOLETOS_SIMOV.NU_BEM')
        ->leftjoin('TBL_CONTRATOSORIGEMSAP', 'TBL_CONTRATOSORIGEMSAP.num_bem_simov',  "=", 'ALITB001_Imovel_Completo.NU_BEM')
        ->select(DB::raw("
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
        ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
        ALITB001_Imovel_Completo.[CPF_CNPJ_PROPONENTE] as cpfCnpjProponente,
        ALITB001_Imovel_Completo.[STATUS_IMOVEL] as statusImovel,
        ALITB001_Imovel_Completo.[STATUS_PROPOSTA] as statusProposta,
        ALITB001_Imovel_Completo.[TIPO_VENDA] as tipoVenda,
        ALITB001_Imovel_Completo.[AGENCIA_CONTRATACAO_PROPOSTA] as agContratacao,
        ALITB001_Imovel_Completo.[ENDERECO_PROPONENTE] as endereco,
        ALITB001_Imovel_Completo.[CIDADE_PROPONENTE] as cidade,
        ALITB001_Imovel_Completo.[UF_PROPONENTE] as uf,
        ALITB001_Imovel_Completo.[CEP_PROPONENTE] as cep,
        FORMAT(ALITB001_Imovel_Completo.[DATA_ENTRADA] , 'dd/MM/yyyy') as dataEntradaSimov,
        FORMAT(CONVERT(DECIMAL(10,2), REPLACE(CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO], ',', '.')), 'N', 'pt-BR') AS valorBoleto,
        REPLACE(CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO], ',', '.') as valorSemFormatacao,
        ISNULL(CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO], 'Sem Pagamento') as dataPagamento,
        TBL_CONTRATOSORIGEMSAP.NUM_OBJ_LOC as objLocacao,
        TBL_CONTRATOSORIGEMSAP.NUM_IMOBILIZADO as numeroImobilizado,
        TBL_CONTRATOSORIGEMSAP.NUM_EDIFICIO as numeroEdificio
      "))
        // ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', $codigoUnidadeUsuarioSessao)
        ->whereIn('CLASSIFICACAO', array('Patrimonial','Patrimonial - Alienação Fiduciária', 'Patrimonial -Realização de Garantia' ))
        ->whereRaw('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.TOTAL_PROPOSTA = CUB_056_PAGAMENTOS_BOLETOS_SIMOV.RECURSOS_PROPRIOS')
        ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.SITUAÇÃO', 'PAGO')
        ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', "!=", "Vendido")
        ->whereNotNull('SITUAÇÃO')
        ->get();

         return json_encode($boletosAvista);
        
    }

    public function criaPlanilhaExcelSapGeral()
    {
        return Excel::download(new criaExcelSAPGeral, 'PlanilhaControleSapGeral.xlsx');
    }
}
