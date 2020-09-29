<?php

namespace App\Http\Controllers\Pagamentos;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\TMA\TMAaVista;
use App\Models\HistoricoPortalGilie;
use App\Models\Bloqueados;
use App\Exports\criaExcelPlanilhaTMAaVista;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pagamentos\Pagamentos;

class gestaoCDPController extends Controller
{


public function gestaoCDP($chb)
    {

    $gestaoCDP= DB::table('TBL_CDP')
        ->join('ALITB001_Imovel_Completo', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_BEM)'), '=', DB::raw('CAST(TBL_CDP.[contrato] as bigint)'))
    
        ->select(DB::raw("
        TBL_CDP.[PROCESSO] as processo,
        TBL_CDP.[CNPJ] as cnpj,
        TBL_CDP.[dataPagamento] as dataPagamento,
        CAST(SQ AS INT) as sq,
        TBL_CDP.[TP] as tp,
        TBL_CDP.[DESPESA] as despesa,
        TBL_CDP.[valor] as valor,
        TBL_CDP.[PG] as pg,
        TBL_CDP.[CLA] as cla
        "))
         ->where('ALITB001_Imovel_Completo.BEM_FORMATADO', '=', $chb)
         ->get();
        return json_encode($gestaoCDP);
    }
   
}