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

class gestaoDDQController extends Controller
{


public function gestaoDDQtabela1($chb)
    {

    $gestaoDDQ= DB::table('TBL_DDQ_1')
        ->join('ALITB001_Imovel_Completo', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_BEM)'), '=', DB::raw('CAST(TBL_DDQ_1.[contrato] as bigint)'))
        ->select(DB::raw("
        TBL_DDQ_1.[nomeStatus] as tipoPagamento,
        FORMAT(CONVERT(DECIMAL(10,2), REPLACE(CAST(CAST(valoresFormatado as money) as numeric(10,2)), ',', '.')), 'N', 'pt-BR') AS valorPagamento
        "))
         ->where('ALITB001_Imovel_Completo.BEM_FORMATADO', '=', $chb)
         ->get();

        return json_encode($gestaoDDQ);
    }

public function gestaoDDQtabela2($chb)
{

$gestaoDDQ= DB::table('TBL_DDQ_2')
    ->join('ALITB001_Imovel_Completo', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_BEM)'), '=', DB::raw('CAST(TBL_DDQ_2.[contrato] as bigint)'))
    ->select(DB::raw("
    TBL_DDQ_2.[nomeStatus] as tipoPagamento,
    FORMAT(CONVERT(DECIMAL(10,2), REPLACE(CAST(CAST(valoresFormatados as money) as numeric(10,2)), ',', '.')), 'N', 'pt-BR') AS valorPagamento
    "))
        ->where('ALITB001_Imovel_Completo.BEM_FORMATADO', '=', $chb)
        ->get();

    return json_encode($gestaoDDQ);
}

public function gestaoDDQDados($chb)
{

$gestaoDDQ= DB::table('TBL_DDQ_DADOS')
    ->join('ALITB001_Imovel_Completo', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_BEM)'), '=', DB::raw('CAST(TBL_DDQ_DADOS.[contrato] as bigint)'))
    ->select(DB::raw("
    TBL_DDQ_DADOS.[nomeStatus] as status,
    TBL_DDQ_DADOS.[valores] as valores
    "))
        ->where('ALITB001_Imovel_Completo.BEM_FORMATADO', '=', $chb)
        ->get();

    return json_encode($gestaoDDQ);
}

   
}