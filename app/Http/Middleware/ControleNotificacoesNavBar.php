<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\GestaoImoveisCaixa\DistratoDemanda;

class ControleNotificacoesNavBar
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
        $request->session()->put([
            'demandasDistratoPendentesParecerGestor' => DistratoDemanda::where('statusAnaliseDistrato', 'AGUARDA PARECER GESTOR')->count(),
            'totalAcoesPendentesGestor' => DistratoDemanda::where('statusAnaliseDistrato', 'AGUARDA PARECER GESTOR')->count(),
        ]);
        return $next($request);
    }
}
