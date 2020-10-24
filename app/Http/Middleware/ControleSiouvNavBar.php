<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Atende;
use App\Classes\Ldap;
use App\Models\Empregado;

class ControleSiouvNavBar
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
            'siouvAtende' => Atende::where('statusAtende','<>', 'FINALIZADO')
            ->where('matriculaResponsavelAtividade', session('matricula'))
            ->where('idAtividade', '76')
            ->count(),
        ]);
        return $next($request);
    }
}