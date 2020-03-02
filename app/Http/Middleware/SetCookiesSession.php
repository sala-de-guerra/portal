<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Classes\Ldap;
use App\Classes\CadastraAcessoPortal;
use App\Models\Empregado;
use App\Models\BaseSimov;
use Illuminate\Support\Carbon;


class SetCookiesSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * 
     */
    public function handle($request, Closure $next)
    {
        if (env('DB_CONNECTION') === 'sqlite') {
            if (!$request->session()->has('matricula')) {
                // $empregado = Empregado::find('c112346'); // Luciano
                // $empregado = Empregado::find('c032579'); // Euclidio
                // $empregado = Empregado::find('c058725'); // Thais
                // $empregado = Empregado::find('c142765'); // Carlos
                // $empregado = Empregado::find('c111710'); // Chuman
                $empregado = Empregado::find('c079436'); // Vladimir

                $request->session()->put([
                    'matricula' => $empregado->matricula,
                    'nomeCompleto' => $empregado->nomeCompleto,
                    'primeiroNome' => $empregado->primeiroNome,
                    'nomeFuncao' => $empregado->nomeFuncao,
                    'codigoLotacaoAdministrativa' => $empregado->codigoLotacaoAdministrativa,
                    'nomeLotacaoAdministrativa' => $empregado->nomeLotacaoAdministrativa,
                    'codigoLotacaoFisica' => $empregado->codigoLotacaoFisica,
                    'nomeLotacaoFisica' => $empregado->nomeLotacaoFisica,
                    'acessoEmpregadoPortal' => $empregado->acessaPortal->nivelAcesso,
                    'unidadeEmpregadoPortal' => $empregado->acessaPortal->unidade
                ]);
            }
        } else {   
            if (!$request->session()->has('matricula')) {
                $usuario = new Ldap;
                $empregado = Empregado::find($usuario->getMatricula());
                $urlBaseSistemaInova = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '/', strpos($_SERVER['REQUEST_URI'], '/')+1));
                $perfilAcessoPortal = new CadastraAcessoPortal($empregado);
                $baseSimov = BaseSimov::select('DATA_ULTIMA_ALTERACAO')->orderBy('DATA_ULTIMA_ALTERACAO', 'desc')->first();

                $request->session()->put([
                    'matricula' => $empregado->matricula,
                    'nomeCompleto' => $empregado->nomeCompleto,
                    'primeiroNome' => $empregado->primeiroNome,
                    'nomeFuncao' => $empregado->nomeFuncao,
                    'codigoLotacaoAdministrativa' => $empregado->codigoLotacaoAdministrativa,
                    'nomeLotacaoAdministrativa' => $empregado->nomeLotacaoAdministrativa,
                    'codigoLotacaoFisica' => $empregado->codigoLotacaoFisica,
                    'nomeLotacaoFisica' => $empregado->nomeLotacaoFisica,
                    'acessoEmpregadoPortal' => $empregado->acessaPortal->nivelAcesso,
                    'unidadeEmpregadoPortal' => $empregado->acessaPortal->unidade,
                    'dataAtualizacaoBaseSimov' => Carbon::parse($baseSimov->DATA_ULTIMA_ALTERACAO)->format('d/m/Y')
                ]); 
            }
        }
        return $next($request);
    }
}