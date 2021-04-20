<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Empregado;
use App\Models\GestaoEquipesEmpregados;
use App\Models\GestaoEquipesCelulas;

class GestaoEquipesEmpregadosMiddleware
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
        $arrayUnidadesAutorizadasParaCadastrarEquipes = [
            '5530', // GEIPT
            '7257', // GILIE/SP
            '7244', // GILIE/BH
            '7243', // GILIE/BE
            '7109', // GILIE/BR
            '7247', // GILIE/CT
            '7248', // GILIE/FO
            '7249', // GILIE/GO
            '7251', // GILIE/PO
            '7254', // GILIE/RJ
            '7253', // GILIE/RE
            '7255', // GILIE/SA
            '7077', // CEPAT
            '7242'  // GILIE/BU

        ];

        $arrayCodigoFuncaoGestao = [
            '2026' // CONSULTOR DE DIRIGENTE
            ,'2267' // CONSULTOR CHEFE DA PRESIDENCIA
            ,'2024' // CHEFE DE GABINETE DA PRESIDENCIA
            ,'2029' // CONSULTOR MATRIZ
            ,'2030' // COORDENADOR DE PROJETOS MATRIZ
            ,'2031' // COORDENADOR DE PROJETOS TI
            ,'2061' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 1
            ,'2062' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 2
            ,'2063' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 3
            ,'2064' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 4
            ,'2079' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 5 
            ,'2080' // COORDENADOR - CENTRALIZADORA/FILIAL - PORTE 6
            ,'2111' // COORDENADOR DE TI - PORTE 1
            ,'2112' // COORDENADOR DE TI - PORTE 2
            ,'2113' // COORDENADOR DE TI - PORTE 3
            ,'2114' // COORDENADOR DE TI - PORTE 4
            ,'2115' // COORDENADOR DE TI - PORTE 5
            ,'2141' // GERENTE DE CENTRALIZADORA - PORTE 1
            ,'2142' // GERENTE DE CENTRALIZADORA - PORTE 2
            ,'2143' // GERENTE DE CENTRALIZADORA - PORTE 3
            ,'2145' // GERENTE DE CENTRALIZADORA - PORTE 4
            ,'2066' // GERENTE DE FILIAL - PORTE 1
            ,'2067' // GERENTE DE FILIAL - PORTE 2
            ,'2068' // GERENTE DE FILIAL - PORTE 3
            ,'2069' // GERENTE DE FILIAL - PORTE 4
            ,'2070' // GERENTE DE FILIAL - PORTE 5
            ,'2038' // GERENTE NACIONAL
            ,'2241' // GERENTE REGIONAL - PORTE 1
            ,'2242' // GERENTE REGIONAL - PORTE 2
            ,'2243' // GERENTE REGIONAL - PORTE 3
            ,'2244' // GERENTE REGIONAL - PORTE 4
            ,'2245' // GERENTE REGIONAL - PORTE 5
            ,'2246' // GERENTE REGIONAL - PORTE 6
            ,'2060' // SUPERVISOR - CENTRALIZADORA/FILIAL
            ,'2037' // GERENTE EXECUTIVO
        ];

        if (in_array(session('codigoLotacaoFisica'), $arrayUnidadesAutorizadasParaCadastrarEquipes) || in_array(session('codigoLotacaoAdministrativa'), $arrayUnidadesAutorizadasParaCadastrarEquipes)) {
            if (!in_array(session('codigoFuncao'), $arrayCodigoFuncaoGestao)) {
                $empregadoGestaoEquipes = GestaoEquipesEmpregados::firstOrNew(array('matricula' => session('matricula')));
                $empregadoGestaoEquipes->matricula = session('matricula');
                $empregadoGestaoEquipes->codigoUnidadeLotacao = !in_array(session('codigoLotacaoFisica'), [null, 'NULL']) ? session('codigoLotacaoFisica') : session('codigoLotacaoAdministrativa');
                $empregadoGestaoEquipes->created_at = $empregadoGestaoEquipes->created_at != null ? $empregadoGestaoEquipes->created_at : date("Y-m-d H:i:s", time());
                $empregadoGestaoEquipes->updated_at = date("Y-m-d H:i:s", time());
                $empregadoGestaoEquipes->save();
            }
        } else {
            $exEmpregadoGestaoEquipes = GestaoEquipesEmpregados::find(session('matricula'));
            if (!is_null($exEmpregadoGestaoEquipes)) {
                $exEmpregadoGestaoEquipes->codigoUnidadeLotacao = !in_array(session('codigoLotacaoFisica'), [null, 'NULL']) ? session('codigoLotacaoFisica') : session('codigoLotacaoAdministrativa');
                $exEmpregadoGestaoEquipes->idEquipe = null;
                $exEmpregadoGestaoEquipes->disponivel = false;
                $exEmpregadoGestaoEquipes->eventualEquipe = false;
                $exEmpregadoGestaoEquipes->updated_at = date("Y-m-d H:i:s", time());
                $exEmpregadoGestaoEquipes->save();
            }
        }
        
        return $next($request);
    }
}
