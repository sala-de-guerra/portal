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

class gestaoDePagamentosController extends Controller
{

public function index()
    {
        return view('portal.pagamentos.gestao-pagamentos');
    }
public function gestaoDePagamentos($chb)
    {

    $gestaoDePagamentos= DB::table('CUB_10_PAGAMENTOS_DESPESAS_SIMOV')
        ->select(DB::raw("
        CUB_10_PAGAMENTOS_DESPESAS_SIMOV.[TIPO_CREDOR] as credor,
        CUB_10_PAGAMENTOS_DESPESAS_SIMOV.[SERVICO] as servico,
        TRY_CONVERT(date, [REFERENCIA_CONTA_DE], 103) as referenciaDe,
        TRY_CONVERT(date, [REFERENCIA_CONTA_ATE], 103) as referenciaAte,
        TRY_CONVERT(date, [DATA_PAGAMENTO], 103) as dataPagamento,
        FORMAT(CONVERT(DECIMAL(10,2), REPLACE([VALOR_PAGAMENTO], ',', '.')), 'N', 'pt-BR') AS valorPagamento,
        FORMAT(CONVERT(DECIMAL(10,2), REPLACE([VALOR_PARCELA], ',', '.')), 'N', 'pt-BR') AS valorParcela,
        CUB_10_PAGAMENTOS_DESPESAS_SIMOV.[NUMERO_COMPROMISSO] as numeroCompromisso,
        CAST(CUB_10_PAGAMENTOS_DESPESAS_SIMOV.VALOR_PARCELA as money) as valor  
        "))
         ->where('CUB_10_PAGAMENTOS_DESPESAS_SIMOV.BEM', '=', $chb)
         ->get();

        return json_encode($gestaoDePagamentos);
    }
}