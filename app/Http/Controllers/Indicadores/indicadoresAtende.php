<?php

namespace App\Http\Controllers\Indicadores;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\LogAcessosPortal;
use Illuminate\Support\Facades\DB;


class indicadoresAtende extends Controller
{
    public function indexIndicadoresAtende()
    {
        return view('portal.atende.atende-indicadores');
    }

    public function mostraTotalAtendesNovos()
    {
        $dadosAtendeAberto = DB::table('TBL_ATENDE_DEMANDAS')
            ->select(DB::raw('
                COUNT(DISTINCT idAtende) as totalAtendeParaResponder
            '))
             ->whereIn('statusAtende', array('CADASTRADO', 'REDIRECIONADO'))
             ->get();
             return json_encode($dadosAtendeAberto);
    }

    public function mostraTotalAtendesFinalizados()
    {
        $dadosAtendeFinalizado = DB::table('TBL_ATENDE_DEMANDAS')
            ->select(DB::raw('
                COUNT(DISTINCT idAtende) as totalAtendesRespondidos
            '))
             ->where('statusAtende', 'FINALIZADO')
             ->get();
             return json_encode($dadosAtendeFinalizado);
    }

    public function mostraTotalAtendesVencidos()
    {
        $dadosAtendeVencido = DB::table('TBL_ATENDE_DEMANDAS')
            ->select(DB::raw('
                COUNT(DISTINCT idAtende) as totalAtendesVencidos
            '))
             ->whereIn('statusAtende', array('CADASTRADO', 'REDIRECIONADO'))
             ->whereRaw('getdate() > TBL_ATENDE_DEMANDAS.[prazoAtendimentoAtende]')
             ->get();
             return json_encode($dadosAtendeVencido);
    }
    
}
