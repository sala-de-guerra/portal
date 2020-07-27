<?php

namespace App\Http\Controllers\vendaAvista;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;


class vendaAvistaController extends Controller
{
    public function indexVendaAVista()
    {
        return view('portal.tma.venda-a-vista');
    }

    public function universoVendaAVista()
    {
    $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
    $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
    $universoAVista= DB::table('TBL_VENDA_AVISTA')
        ->select(DB::raw('
            TBL_VENDA_AVISTA.[BEM_FORMATADO] as BEM_FORMATADO,
            TBL_VENDA_AVISTA.[NU_BEM] as NU_BEM,
            TBL_VENDA_AVISTA.[PAGAMENTO_BOLETO] as PAGAMENTO_BOLETO,
            TBL_VENDA_AVISTA.[UNA] as UNA,
            TBL_VENDA_AVISTA.[DIAS_DECORRIDOS] as DIAS_DECORRIDOS,
            TBL_VENDA_AVISTA.[CLASSIFICACAO] as CLASSIFICACAO,
            TBL_VENDA_AVISTA.[NOME_PROPONENTE] as NOME_PROPONENTE,
            TBL_VENDA_AVISTA.[CPF_CNPJ_PROPONENTE] as CPF_CNPJ_PROPONENTE


        '))
         ->where('TBL_VENDA_AVISTA.UNA', '=', $siglaGilie)
         ->get();

         return json_encode($universoAVista);
    }
  
}