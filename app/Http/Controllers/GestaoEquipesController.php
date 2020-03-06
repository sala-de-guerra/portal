<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empregado;
use App\Models\GestaoEquipesLogHistorico;
use App\Models\GestaoEquipesEmpregados;
use App\Models\GestaoEquipesCelulas;
use App\Models\GestaoEquipesAlocarEmpregado;
use Illuminate\Support\Facades\DB;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;

class GestaoEquipesController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.gerencial.equipes');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function listarEquipesUnidade()
    {
        // $relacaoEmpregadosNaoAlocados = GestaoEquipesEmpregados::with(
        //     ['dadosEmpregadoLdap' => function($dadosEmpregadoLdap) use($arrayCodigoGestores) {
        //     json_encode($dadosEmpregadoLdap->whereNotIn('codigoFuncao', self::listarCodigoGestores()), JSON_UNESCAPED_SLASHES);
        // }])->get();
        // dd($relacaoEmpregadosNaoAlocados);
        $arrayEquipesUnidade = [];
        $relacaoEquipesUnidade = GestaoEquipesCelulas::where('ativa', true)->where('codigoUnidadeEquipe', session('codigoLotacaoAdministrativa'))->orWhere('codigoUnidadeEquipe', null)->get();
        foreach ($relacaoEquipesUnidade as $equipe) {
            $codigoUnidade = $equipe->codigoUnidadeEquipe;
            if (is_null($equipe->codigoUnidadeEquipe)) {
                $relacaoEmpregadosNaoAlocados = GestaoEquipesEmpregados::where('idEquipe', null)->where(function($lotacao) {
                    $lotacao->where('codigoUnidadeLotacao', session('codigoLotacaoAdministrativa'))
                            ->orWhere('codigoUnidadeLotacao', session('codigoLotacaoFisica'));
                    })->get();
                $arrayEmpregadosNaoAlocados = [];
                foreach ($relacaoEmpregadosNaoAlocados as $empregadoNaoAlocado) {
                    $arrayEmpregadosNaoAlocados = self::incluirEmpregadoNaEquipe($arrayEmpregadosNaoAlocados, $empregadoNaoAlocado);
                }
                $arrayEquipesUnidade = self::incluirEquipeNoArray($arrayEquipesUnidade, $equipe, $arrayEmpregadosNaoAlocados);
            } else {
                $relacaoEmpregadosEquipe = GestaoEquipesEmpregados::where('idEquipe', $equipe->idEquipe)->get();
                $arrayEmpregadosEquipe = [];
                foreach ($relacaoEmpregadosEquipe as $empregadoEquipe) {
                    $arrayEmpregadosEquipe = self::incluirEmpregadoNaEquipe($arrayEmpregadosEquipe, $empregadoEquipe);
                }
                $arrayEquipesUnidade = self::incluirEquipeNoArray($arrayEquipesUnidade, $equipe, $arrayEmpregadosEquipe);
            }
        }
        return json_encode(array((string) $codigoUnidade => $arrayEquipesUnidade));
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarEquipe(Request $request)
    {
        $objDados = explode("&", str_replace('"', '', $request->data));
        foreach ($objDados as $dado) {
            $dado = explode("=", $dado);
            switch ($dado[0]) {
                case 'codigoUnidadeEquipe':
                    $codigoUnidadeEquipe = $dado[1];
                    break;
                case 'nomeEquipe':
                    $nomeEquipe = $dado[1];
                    break;
                case 'matriculaGestor':
                    $matriculaGestor = $dado[1];
                    break;
                case 'nomeGestor':
                    $nomeGestor = $dado[1];
                    break;
            }
        }

        try {
            DB::beginTransaction();
            // CRIA A NOVA EQUIPE
            $novaEquipe = new GestaoEquipesCelulas;
            $novaEquipe->codigoUnidadeEquipe    = !in_array(session('codigoLotacaoFisica'), [null, 'NULL']) ? session('codigoLotacaoFisica') : session('codigoLotacaoAdministrativa');
            $novaEquipe->nomeEquipe             = strtoupper($nomeEquipe);
            $novaEquipe->matriculaGestor        = isset($matriculaGestor) ? $matriculaGestor : null;
            $novaEquipe->nomeGestor             = isset($nomeGestor) ? $nomeGestor : null;
            $novaEquipe->responsavelEdicao      = session('matricula');
            $novaEquipe->created_at             = date("Y-m-d H:i:s", time());
            $novaEquipe->updated_at             = date("Y-m-d H:i:s", time());
            $novaEquipe->save();

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $novaEquipe->idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'CADASTRO';
            $registroLogHistorico->observacao               = "CADASTRO DA EQUIPE " . strtoupper($nomeEquipe);
            $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
            $registroLogHistorico->save();

            DB::commit();
            return response('equipe cadastrada com sucesso', 200);
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            return response('Não foi possível cadastrar a equipe', 500);
        }
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editarCadastroEquipe(Request $request)
    {
        $objDados = explode("&", str_replace('"', '', $request->data));
        foreach ($objDados as $dado) {
            $dado = explode("=", $dado);
            switch ($dado[0]) {
                case 'codigoUnidadeEquipe':
                    $codigoUnidadeEquipe = $dado[1];
                    break;
                case 'nomeEquipe':
                    $nomeEquipe = $dado[1];
                    break;
                case 'matriculaGestor':
                    $matriculaGestor = $dado[1];
                    break;
                case 'nomeGestor':
                    $nomeGestor = $dado[1];
                    break;
                case 'idEquipe':
                    $idEquipe = $dado[1];
                    break;
                case 'matriculaEventual':
                    $matriculaEventual = $dado[1];
                    break;
                case 'nomeEventual':
                    $nomeEventual = $dado[1];
                    break;
            }
        }

        try {
            DB::beginTransaction();
            // SENSIBILIZA A EVENTUALIDADE NAS TABELAS ANTES DE PERSISTIR NA TABELA DE EQUIPE
            $editarEquipe = GestaoEquipesCelulas::find($idEquipe);
            if (isset($matriculaEventual)) {
                $matriculaAntigoEventual = $editarEquipe->matriculaEventual;
                if (!is_null($matriculaAntigoEventual)) {
                    // REMOVE O ANTIGO EVENTUAL
                    $antigoEventual = GestaoEquipesEmpregados::find($matriculaAntigoEventual);
                    $antigoEventual->eventualEquipe = false;
                    $antigoEventual->updated_at = date("Y-m-d H:i:s", time());

                    // REGISTRA O LOG DE HISTORICO DA AÇÃO
                    $registroLogHistorico = new GestaoEquipesLogHistorico;
                    $registroLogHistorico->idEquipe                 = $idEquipe;
                    $registroLogHistorico->matriculaResponsavel     = session('matricula');
                    $registroLogHistorico->tipo                     = 'EDIÇÃO';
                    $registroLogHistorico->observacao               = "REMOÇÃO DA EVENTUALIDADE - " . $antigoEventual->dadosEmpregadoLdap->nomeCompleto;
                    $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
                    $registroLogHistorico->save();

                    $antigoEventual->save();

                    // DESIGNA O ANTIGO EVENTUAL
                    $novoEventual = GestaoEquipesEmpregados::find($matriculaEventual);
                    $novoEventual->eventualEquipe = true;
                    $novoEventual->updated_at = date("Y-m-d H:i:s", time());
                    
                    // REGISTRA O LOG DE HISTORICO DA AÇÃO
                    $registroLogHistorico = new GestaoEquipesLogHistorico;
                    $registroLogHistorico->idEquipe                 = $idEquipe;
                    $registroLogHistorico->matriculaResponsavel     = session('matricula');
                    $registroLogHistorico->tipo                     = 'EDIÇÃO';
                    $registroLogHistorico->observacao               = "DESIGNAÇÃO DE EVENTUALIDADE - " . $novoEventual->dadosEmpregadoLdap->nomeCompleto;
                    $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
                    $registroLogHistorico->save();

                    $novoEventual->save();
                }
            }

            // EDITAR EQUIPE
            $editarEquipe->nomeEquipe             = !in_array($nomeEquipe, [null, 'NULL']) ? strtoupper($nomeEquipe) : $editarEquipe->nomeEquipe;
            $editarEquipe->matriculaGestor        = !in_array($matriculaGestor, [null, 'NULL']) ? strtoupper($matriculaGestor) : $editarEquipe->matriculaGestor;
            $editarEquipe->nomeGestor             = !in_array($nomeGestor, [null, 'NULL']) ? strtoupper($nomeGestor) : $editarEquipe->nomeGestor;
            $editarEquipe->matriculaEventual      = !in_array($matriculaEventual, [null, 'NULL']) ? strtoupper($matriculaEventual) : $editarEquipe->matriculaEventual;
            $editarEquipe->nomeEventual           = !in_array($nomeEventual, [null, 'NULL']) ? strtoupper($nomeEventual) : $editarEquipe->nomeEventual;
            $editarEquipe->responsavelEdicao      = session('matricula');
            $editarEquipe->updated_at             = date("Y-m-d H:i:s", time());

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $editarEquipe->idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'EDIÇÃO';
            $registroLogHistorico->observacao               = "EDIÇÃO DOS DADOS DA EQUIPE " . strtoupper($editarEquipe->nomeEquipe);
            $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
            $registroLogHistorico->save();

            $editarEquipe->save();
            DB::commit();
            return response('equipe editada com sucesso', 200);
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            return response('Não foi possível editar a equipe', 500);
        }
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function alocarEmpregadoEquipe(Request $request)
    {
        try {
            DB::beginTransaction();
            // ALOCAR EMPREGADO
            $empregadoAlocado = GestaoEquipesEmpregados::find($request->matricula);
            $empregadoAlocado->idEquipe     = $request->idEquipe;
            $empregadoAlocado->updated_at   = date("Y-m-d H:i:s", time());

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $request->idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'ALOCAÇÃO';
            $registroLogHistorico->observacao               = "ALOCAÇÃO DO EMPREGADO " . $empregadoAlocado->dadosEmpregadoLdap->nomeCompleto;
            $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
            $registroLogHistorico->save();

            $empregadoAlocado->save();
            DB::commit();
            return response('empregado alocado com sucesso', 200);
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            return response('Não foi possível alocar o empregado', 500);
        }
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function desativarEquipe(Request $request)
    {
        dd($request);
        try {
            DB::beginTransaction();
            // SENSIBILIZA A EVENTUALIDADE NAS TABELAS ANTES DE PERSISTIR NA TABELA DE EQUIPE
            $desativarEquipe = GestaoEquipesCelulas::find($request->idEquipe);
            $desativarEquipe->ativa        = $request->ativa;
            $desativarEquipe->updated_at   = date("Y-m-d H:i:s", time());

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $request->idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'DESATIVAR';
            $registroLogHistorico->observacao               = "DESATIVAÇÃO DA EQUIPE " . $request->nomeEquipe;
            $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
            $registroLogHistorico->save();

            $desativarEquipe->save();
            DB::commit();
            return response('equipe apagada com sucesso', 200);
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            return response('Não foi possível apagar a equipe', 500);
        }
    }

    public static function incluirEmpregadoNaEquipe($arrayEmpregadosEquipe, $objetoGestaoEquipesEmpregados) {
        array_push($arrayEmpregadosEquipe, [
            'matricula'     => $objetoGestaoEquipesEmpregados->matricula,
            'nomeCompleto'  => $objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeCompleto,
            'nomeFuncao'    => is_null($objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeFuncao) ? 'TECNICO BANCARIO NOVO' : $objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeFuncao,
        ]);
        return $arrayEmpregadosEquipe;
    }

    public static function incluirEquipeNoArray($arrayEquipes, $objGestaoEquipesCelulas, $arrayEmpregadosEquipe){
        array_push($arrayEquipes, [
            'idEquipe'                  => (string) $objGestaoEquipesCelulas->idEquipe,
            'nomeEquipe'                => $objGestaoEquipesCelulas->nomeEquipe,
            'nomeGestorEquipe'          => $objGestaoEquipesCelulas->nomeGestor,
            'matriculaGestorEquipe'     => $objGestaoEquipesCelulas->matriculaGestor,
            'nomeEventualEquipe'        => $objGestaoEquipesCelulas->nomeEventual,
            'matriculaEventualEquipe'   => $objGestaoEquipesCelulas->matriculaEventual,
            'empregadosEquipe'          => $arrayEmpregadosEquipe
        ]);
        return $arrayEquipes;
    }

    public static function listaGestoresUnidade()
    {
        $listaGestoresUnidade = Empregado::where(function($lotacao) {
            $lotacao->where('codigoLotacaoAdministrativa', session('codigoLotacaoAdministrativa'))
                    ->orWhere('codigoLotacaoFisica', session('codigoLotacaoFisica'));   
        })->whereIn('codigoFuncao', self::listarCodigoGestores())->select('matricula', 'nomeCompleto', 'nomeFuncao')->get();

        return json_encode($listaGestoresUnidade);
    }

    public function listarUnidades()
    {
        return json_encode(array('unidades' => [
            '5530' => 'GEIPT',
            '7257' => 'GILIE/SP',
            '7244' => 'GILIE/BH',
            '7243' => 'GILIE/BE',
            '7109' => 'GILIE/BR',
            '7247' => 'GILIE/CT',
            '7248' => 'GILIE/FO',
            '7249' => 'GILIE/GO',
            '7251' => 'GILIE/PO',
            '7254' => 'GILIE/RJ',
            '7253' => 'GILIE/RE',
            '7255' => 'GILIE/SA',
            '7242' => 'GILIE/BU'
        ]));
    }

    public static function listarCodigoGestores()
    {
        return [
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
    }

    public static function trataDadosAjax($dadosRequest)
    {
        $objDados = explode("&", str_replace('"', '', $request->data));
        foreach ($objDados as $dado) {
            $dado = explode("=", $dado);
            switch ($dado[0]) {
                case 'codigoUnidadeEquipe':
                    $codigoUnidadeEquipe = $dado[1];
                    break;
                case 'nomeEquipe':
                    $nomeEquipe = $dado[1];
                    break;
                case 'matriculaGestor':
                    $matriculaGestor = $dado[1];
                    break;
                case 'nomeGestor':
                    $nomeGestor = $dado[1];
                    break;
            }
        }
        return ;
    }
}
