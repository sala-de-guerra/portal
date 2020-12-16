<?php

namespace App\Http\Controllers\Dijur;

use App\Classes\DiasUteisClass;
use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\HistoricoPortalGilie;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;

class dijurController extends Controller
{
    public function dijurIndex()
    {
        return view('portal.gerencial.gestao-subsidios');
    }

    public function listaUniversoDijur()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $listaDijur = DB::table('TBL_DADOS_SIJUR')
        ->leftjoin('ALITB001_Imovel_Completo', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_BEM)'), '=', DB::raw('CONVERT(VARCHAR, TBL_DADOS_SIJUR.Contrato)'))    
        ->select(DB::raw("
        TBL_DADOS_SIJUR.[situacao],
        TBL_DADOS_SIJUR.[seq],
        TBL_DADOS_SIJUR.[tipo],
        TBL_DADOS_SIJUR.[prazoComMulta],
        TBL_DADOS_SIJUR.[dataSolicitação],
        TBL_DADOS_SIJUR.[dataRetorno],
        TBL_DADOS_SIJUR.[processo],
        TBL_DADOS_SIJUR.[parte],
        TBL_DADOS_SIJUR.[cpfCnpj],
        ISNULL(TBL_DADOS_SIJUR.[Contrato], 'Não Cadastrado') as Contrato,
        TBL_DADOS_SIJUR.[Contrato],
        TBL_DADOS_SIJUR.[advogado],
        TBL_DADOS_SIJUR.[solicitante],
        TBL_DADOS_SIJUR.[observacao],
        TBL_DADOS_SIJUR.[emailResposta],
        ALITB001_Imovel_Completo.[UNA] as gilie,
        TBL_DADOS_SIJUR.[dataEHoraCaptura]
      "))
        ->get(); 
        
        return json_encode($listaDijur);
    }

    public function teste()
    {
        $teste = DB::connection('sqlsrv_sisadj')->table('ADJ_TBL_PAGAMENTOS')
        ->select(DB::raw("
        ADJ_TBL_PAGAMENTOS.[id_pagamento]
      "))
      ->where('ADJ_TBL_PAGAMENTOS.id_pagamento', '1')
        ->get(); 
        
        return json_encode($teste);
    }
}
