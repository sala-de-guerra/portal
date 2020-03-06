<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Ldap;
use App\Models\Empregado;
use App\Models\GestaoEquipesEmpregados;

class CadastraEquipeTblEmpregadosTblGestaoEquipeEmpregadosController extends Controller
{
    public function CadastraEquipeTblEmpregadosTblGestaoEquipeEmpregadosController()
    {
        $arrayMatriculasEmpregadosUnidade = [
            'c034031',
            'c078433',
            'c074575',
            'c092895',
            'c078441',
            'c090719',
            'c082403',
            'c142765',
            'c052847',
            'c050505',
            'c052256',
            'c134752',
            'c111710',
            'c051699',
            'c099389',
            'c142639',
            'c072452',
            'c139620',
            'c085308',
            'c066241',
            'c081629',
            'c062674',
            'c130343',
            'c095043',
            'c090120',
            'c052462',
            'c141203',
            'c090681',
            'c061913',
            'c136175',
            'c067556',
            'c098453',
            'c088674',
            'c066517',
            'c124276',
            'c086588',
            'c136667',
            'c059653',
            'c104966',
            'c854570',
            'c063299',
            'c061649',
            'c052124',
            'c080725',
            'c058948',
            'c076585',
            'c079436',
        ];
    
        $arrayCodigoFuncaoGestao = [
            '2030' // COORDENADOR DE PROJETOS MATRIZ
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
    
        $empregadosCadastrados = 0;
        foreach ($arrayMatriculasEmpregadosUnidade as $matriculaEmpregadoUnidade) {
            $empregadoLdap = new Ldap($matriculaEmpregadoUnidade);
            $empregado = Empregado::find($matriculaEmpregadoUnidade);
    
            if (!in_array($empregado->codigoFuncao, $arrayCodigoFuncaoGestao)) {
                $empregadoGestaoEquipes = GestaoEquipesEmpregados::firstOrNew(array('matricula' => $matriculaEmpregadoUnidade));
                $empregadoGestaoEquipes->matricula = $matriculaEmpregadoUnidade;
                $empregadoGestaoEquipes->codigoUnidadeLotacao = !in_array($empregado->codigoLotacaoFisica, [null, 'NULL']) ? $empregado->codigoLotacaoFisica : $empregado->codigoLotacaoAdministrativa;
                $empregadoGestaoEquipes->created_at = $empregadoGestaoEquipes->created_at != null ? $empregadoGestaoEquipes->created_at : date("Y-m-d H:i:s", time());
                $empregadoGestaoEquipes->updated_at = date("Y-m-d H:i:s", time());
                $empregadoGestaoEquipes->save();
            }
    
            $empregadosCadastrados++;
        }
        return "Empregados cadatrados: $empregadosCadastrados";
    }
}
