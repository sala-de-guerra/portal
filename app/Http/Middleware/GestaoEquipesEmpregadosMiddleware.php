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
     */
    public function handle($request, Closure $next)
    {
        $arrayUnidadesAutorizadasParaCadastrarEquipes = [
            '7257', //GILIE/SP'
            '7244', //GILIE/BH'
            '7243', //GILIE/BE'
            '7109', //GILIE/BR'
            '7247', //GILIE/CT'
            '7248', //GILIE/FO'
            '7249', //GILIE/GO'
            '7251', //GILIE/PO'
            '7254', //GILIE/RJ'
            '7253', //GILIE/RE'
            '7255', //GILIE/SA'
            '7242' //GILIE/BU'
        ];

        if (in_array(session('codigoLotacaoFisica'), $arrayUnidadesAutorizadasParaCadastrarEquipes) || in_array(session('codigoLotacaoAdministrativa'), $arrayUnidadesAutorizadasParaCadastrarEquipes)) {
            $empregadoGestaoEquipes = GestaoEquipesEmpregados::firstOrNew(array('matricula' => session('matricula')));
            $empregadoGestaoEquipes->matricula = session('matricula');
            $empregadoGestaoEquipes->codigoUnidadeLotacao = !in_array(session('codigoLotacaoFisica'), [null, 'NULL']) ? session('codigoLotacaoFisica') : session('codigoLotacaoAdministrativa');
            $empregadoGestaoEquipes->created_at = $empregadoGestaoEquipes->created_at != null ? $empregadoGestaoEquipes->created_at : date("Y-m-d H:i:s", time());
            $empregadoGestaoEquipes->updated_at = date("Y-m-d H:i:s", time());
            $empregadoGestaoEquipes->save();
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
