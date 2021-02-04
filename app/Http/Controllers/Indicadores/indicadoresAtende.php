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
        $dadosAtendeNovos= DB::table('TBL_ATENDE_DEMANDAS')
            ->select(DB::raw('
                COUNT(DISTINCT idAtende) as totalAtendesNovos
            '))
             ->whereRaw('CONVERT(date, getdate()) = CONVERT(date, dataCadastro)')
             ->get();
             return json_encode($dadosAtendeNovos);
    }

    public function mostraTotalAtendesParaResponder()
    {
        $dadosAtendeAberto = DB::table('TBL_ATENDE_DEMANDAS')
            ->select(DB::raw('
                COUNT(DISTINCT idAtende) as totalAtendeParaResponder
            '))
             ->whereIn('statusAtende', array('CADASTRADO', 'REDIRECIONADO'))
             ->whereRaw('getdate() <= TBL_ATENDE_DEMANDAS.[prazoAtendimentoAtende]')
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
             ->whereRaw('CONVERT(date, getdate()) = CONVERT(date, dataAlteracao)')
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

    public function listaAtendeVencidos()
    {
        $dadosAtendeVencido = DB::table('TBL_ATENDE_DEMANDAS')
        ->join('TBL_EMPREGADOS', DB::raw('CONVERT(VARCHAR, TBL_EMPREGADOS.matricula)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade)'))
            ->select(DB::raw('
            TBL_ATENDE_DEMANDAS.idAtende,
            TBL_ATENDE_DEMANDAS.contratoFormatado,
            TBL_ATENDE_DEMANDAS.numeroContrato,
            TBL_EMPREGADOS.nomeCompleto as nomeResponsavelAtividade,
            datediff(day,getdate(), TBL_ATENDE_DEMANDAS.[prazoAtendimentoAtende]) as diasVencido
            '))
             ->whereIn('statusAtende', array('CADASTRADO', 'REDIRECIONADO'))
             ->whereRaw('getdate() > TBL_ATENDE_DEMANDAS.[prazoAtendimentoAtende]')
             ->get();
             return json_encode($dadosAtendeVencido);
    }

    public function listaAtendeNovos()
    {
        $listaAtendesNovos = DB::table('TBL_ATENDE_DEMANDAS')
        ->join('TBL_EMPREGADOS', DB::raw('CONVERT(VARCHAR, TBL_EMPREGADOS.matricula)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade)'))
            ->select(DB::raw('
            TBL_ATENDE_DEMANDAS.idAtende,
            TBL_ATENDE_DEMANDAS.contratoFormatado,
            TBL_ATENDE_DEMANDAS.numeroContrato,
            TBL_EMPREGADOS.nomeCompleto as nomeResponsavelAtividade
            '))
            ->whereRaw('CONVERT(date, getdate()) = CONVERT(date, dataCadastro)')
            ->get();
             return json_encode($listaAtendesNovos);
    }

    public function listaAtendeTratados()
    {
        $listaAtendesTratados = DB::table('TBL_ATENDE_DEMANDAS')
        ->join('TBL_EMPREGADOS', DB::raw('CONVERT(VARCHAR, TBL_EMPREGADOS.matricula)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade)'))
            ->select(DB::raw('
            TBL_ATENDE_DEMANDAS.idAtende,
            TBL_ATENDE_DEMANDAS.contratoFormatado,
            TBL_ATENDE_DEMANDAS.numeroContrato,
            TBL_EMPREGADOS.nomeCompleto as nomeResponsavelAtividade
            '))
            ->where('statusAtende', 'FINALIZADO')
            ->whereRaw('CONVERT(date, getdate()) = CONVERT(date, dataAlteracao)')
            ->get();
             return json_encode($listaAtendesTratados);
    }

    public function listaAtendesParaResponder()
    {
        $dadosAtendeAberto = DB::table('TBL_ATENDE_DEMANDAS')
        ->join('TBL_EMPREGADOS', DB::raw('CONVERT(VARCHAR, TBL_EMPREGADOS.matricula)'), '=', DB::raw('CONVERT(VARCHAR, TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade)'))
            ->select(DB::raw('
            TBL_ATENDE_DEMANDAS.idAtende,
            TBL_ATENDE_DEMANDAS.contratoFormatado,
            TBL_ATENDE_DEMANDAS.numeroContrato,
            TBL_EMPREGADOS.nomeCompleto as nomeResponsavelAtividade
            '))
             ->whereIn('statusAtende', array('CADASTRADO', 'REDIRECIONADO'))
             ->whereRaw('getdate() <= TBL_ATENDE_DEMANDAS.[prazoAtendimentoAtende]')
             ->get();
             return json_encode($dadosAtendeAberto);
    }

    public function listaRelatorioGeralAtendes()
    {
        $listaRelatorioGeralAtendes = DB::select("
        with relatorio_atende as (
            Select  
            'matricula' = matriculaResponsavelAtividade
            ,'finalizado' = 0
            ,'novos' = count(statusAtende)
            ,'pendente' = 0
            ,'vencido' = 0
            ,'nome' = TBL_EMPREGADOS.nomeCompleto
            from TBL_ATENDE_DEMANDAS
            INNER JOIN [TBL_EMPREGADOS] ON TBL_EMPREGADOS.matricula = TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade
            WHERE statusAtende in ('CADASTRADO', 'REDIRECIONADO') -- FINALIZADO REDIRECIONADO
            and CONVERT(date, getdate()) = CONVERT(date, dataAlteracao)
            group by matriculaResponsavelAtividade,TBL_EMPREGADOS.nomeCompleto
            
            
            union 
            
            Select  
            'matricula' = matriculaResponsavelAtividade
            ,'finalizado' = 0
            ,'novos' = 0
            ,'pendente' = count(statusAtende)
            ,'vencido' = 0
            ,'nome' = TBL_EMPREGADOS.nomeCompleto
            from TBL_ATENDE_DEMANDAS
            INNER JOIN [TBL_EMPREGADOS] ON TBL_EMPREGADOS.matricula = TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade
            WHERE statusAtende in ('CADASTRADO', 'REDIRECIONADO') -- FINALIZADO REDIRECIONADO
            group by matriculaResponsavelAtividade,TBL_EMPREGADOS.nomeCompleto
            
            union 
            
            Select  
            'matricula' = matriculaResponsavelAtividade
            ,'finalizado' = count(statusAtende)
            ,'novos' = 0
            ,'pendente' = 0
            ,'vencido' = 0
            ,'nome' = TBL_EMPREGADOS.nomeCompleto
            from TBL_ATENDE_DEMANDAS
            INNER JOIN [TBL_EMPREGADOS] ON TBL_EMPREGADOS.matricula = TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade
            WHERE statusAtende = 'FINALIZADO' -- FINALIZADO REDIRECIONADO
            and CONVERT(date, getdate()) = CONVERT(date, dataAlteracao)
            group by matriculaResponsavelAtividade,TBL_EMPREGADOS.nomeCompleto
            
            union 
            
            Select  
            'matricula' = matriculaResponsavelAtividade
            ,'finalizado' = 0
            ,'novos' = 0
            ,'pendente' = 0
            ,'vencido' = count(statusAtende)
            ,'nome' = TBL_EMPREGADOS.nomeCompleto
            from TBL_ATENDE_DEMANDAS
            INNER JOIN [TBL_EMPREGADOS] ON TBL_EMPREGADOS.matricula = TBL_ATENDE_DEMANDAS.matriculaResponsavelAtividade
            WHERE statusAtende in ('CADASTRADO', 'REDIRECIONADO')  -- FINALIZADO REDIRECIONADO
            and getdate() > prazoAtendimentoAtende
            group by matriculaResponsavelAtividade,TBL_EMPREGADOS.nomeCompleto
            
            )
            
            select 
                matricula
                ,nome
                ,'finalizado' = sum(finalizado)
                ,'novos' = sum(novos)
                ,'pendente' = sum(pendente)
                ,'vencido' = sum(vencido)
            from relatorio_atende
            group by matricula,nome
            ");
             return json_encode($listaRelatorioGeralAtendes);
    }

    public function listaUltimos30diasParaGrafico()
    {
        $listaRelatorioGeralAtendes = DB::select("
        SELECT 
        COUNT(DISTINCT idAtende) as total
        ,CONVERT(DATE, dataCadastro) as dataCadastro
        FROM TBL_ATENDE_DEMANDAS where dataAlteracao >= DATEADD(day,-30,GETDATE())
        group by CONVERT(DATE, dataCadastro)
        order by CONVERT(DATE, dataCadastro) asc
            ");
         return json_encode($listaRelatorioGeralAtendes);
    }

    public function listaUltimos30diasRespondidosParaGrafico()
    {
        $listaRelatorioGeralAtendes = DB::select("
        SELECT 
        COUNT(DISTINCT idAtende) as totalRespondido
        ,CONVERT(DATE, dataAlteracao) as dataAlteracao
        FROM TBL_ATENDE_DEMANDAS where dataAlteracao >= DATEADD(day,-30,GETDATE())
        and statusAtende = 'Finalizado'
        group by CONVERT(DATE, dataAlteracao)
        order by CONVERT(DATE, dataAlteracao) asc
            ");
         return json_encode($listaRelatorioGeralAtendes);
    }
    
}
