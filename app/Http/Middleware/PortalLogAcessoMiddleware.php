<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LogAcessosPortal;


class PortalLogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $inovaLogAcesso = new LogAcessosPortal;
        $inovaLogAcesso->dataAcesso = date("Y-m-d H:i:s", time());
        $inovaLogAcesso->matricula = $request->session()->get('matricula');
        
        // VALIDA TIPO DE ACESSO - CONSULTA OU CADASTRO
        $inovaLogAcesso->tipoAcaoAcesso = 'CONSULTA';

        // CAPTURA QUAL É O SISTEMA DO INOVA E O NOME DA URL REQUISITADA
        if (strpos(preg_replace('/[0-9]+/', '', $request->path()), "/") !== false) {
            $inovaLogAcesso->sistema = substr(preg_replace('/[0-9]+/', '', $request->path()), 0, strpos(preg_replace('/[0-9]+/', '', $request->path()), "/"));
        } else {
            $inovaLogAcesso->sistema = preg_replace('/[0-9]+/', '', $request->path());
        }
        $inovaLogAcesso->nomePagina = preg_replace('/[0-9]+/', '', $request->path());
        
        // CAPTURA NAVEGADOR E A VERSÃO DELE
        $inovaLogAcesso->nomeNavegador = \Browser::browserFamily();
        $inovaLogAcesso->versaoNavegador = \Browser::browserVersion();
        $inovaLogAcesso->save();

        return $next($request);
    }
}