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
    public function listarEquipesUnidade($codigoUnidade)
    {
        $arrayEquipesUnidade = [];
        $relacaoEquipesUnidade = GestaoEquipesCelulas::where('ativa', true)->where('codigoUnidadeEquipe', $codigoUnidade)->orWhere('codigoUnidadeEquipe', null)->get();
        foreach ($relacaoEquipesUnidade as $equipe) {
            if (is_null($equipe->codigoUnidadeEquipe)) {
                $relacaoEmpregadosNaoAlocados = GestaoEquipesEmpregados::where(function($idEquipe){
                    $idEquipe->whereNull('idEquipe')->orWhere('idEquipe', 1);
                })->where('codigoUnidadeLotacao', $codigoUnidade)->get();
                $arrayEmpregadosNaoAlocados = [];
                foreach ($relacaoEmpregadosNaoAlocados as $empregadoNaoAlocado) {
                    $arrayEmpregadosNaoAlocados = self::incluirEmpregadoNoArrayDaEquipe($arrayEmpregadosNaoAlocados, $empregadoNaoAlocado);
                }
                $arrayEquipesUnidade = self::incluirEquipeNoArray($arrayEquipesUnidade, $equipe, $arrayEmpregadosNaoAlocados);
            } else {
                $relacaoEmpregadosEquipe = GestaoEquipesEmpregados::where('idEquipe', $equipe->idEquipe)->get();
                $arrayEmpregadosEquipe = [];
                foreach ($relacaoEmpregadosEquipe as $empregadoEquipe) {
                    $arrayEmpregadosEquipe = self::incluirEmpregadoNoArrayDaEquipe($arrayEmpregadosEquipe, $empregadoEquipe);
                }
                $arrayEquipesUnidade = self::incluirEquipeNoArray($arrayEquipesUnidade, $equipe, $arrayEmpregadosEquipe);
            }
        }
        return json_encode($arrayEquipesUnidade);
    }

    public function listarEmpregadosEquipe($idEquipe)
    {
        $equipe = GestaoEquipesCelulas::find($idEquipe);
        $relacaoEmpregadosEquipe = GestaoEquipesEmpregados::where('idEquipe', $equipe->idEquipe)->where('disponivel', true)->get();
        $arrayEmpregadosEquipe = [];
        foreach ($relacaoEmpregadosEquipe as $empregadoEquipe) {
            if ($empregadoEquipe->matricula != session('matricula')) {
                $arrayEmpregadosEquipe = self::incluirEmpregadoNoArrayDaEquipe($arrayEmpregadosEquipe, $empregadoEquipe);
            }
        }

        $responsavelEquipe = Empregado::find($equipe->matriculaGestor);
        array_push($arrayEmpregadosEquipe, [
            'matricula'     => $responsavelEquipe->matricula,
            'nomeCompleto'  => $responsavelEquipe->nomeCompleto,
            'nomeFuncao'    => is_null($responsavelEquipe->nomeFuncao) ? 'TECNICO BANCARIO NOVO' : $responsavelEquipe->nomeFuncao,
 
        ]);
        return json_encode($arrayEmpregadosEquipe);
    }

    public function listarEquipes($codigoUnidade)
    {
        $relacaoEquipesUnidade = GestaoEquipesCelulas::where('ativa', true)->where('codigoUnidadeEquipe', $codigoUnidade)->where('incluirEquipeAtende', true)->get();
        
        $arrayEquipesUnidade = [];
        foreach ($relacaoEquipesUnidade as $equipe) {
            array_push($arrayEquipesUnidade, [
                'idEquipe'      => $equipe->idEquipe,
                'nomeEquipe'    => $equipe->nomeEquipe,
                'iconeEquipe'   => $equipe->iconeEquipe,
            ]);
        }
        return json_encode($arrayEquipesUnidade);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarEquipe(Request $request)
    {
        $objDados = explode("&", str_replace('"', '', urldecode($request->data)));
        foreach ($objDados as $dado) {
            $dado = explode("=", $dado);
            switch ($dado[0]) {
                case 'codigoUnidadeEquipe':
                    $codigoUnidadeEquipe = $dado[1];
                    break;
                case 'nomeEquipe':
                    $encoding = mb_internal_encoding();
                    $nomeEquipe = mb_strtoupper($dado[1], $encoding);
                    break;
                case 'matriculaGestor':
                    $matriculaGestor = $dado[1];
                    break;
                case 'nomeGestor':
                    $nomeGestor = $dado[1];
                    break;
                case 'incluirEquipeAtende':
                    $incluirEquipeAtende = $dado[1] == '' ? null : $dado[1];
                    break;
                case 'iconeEquipe':
                    $iconeEquipe = $dado[1] == '' ? null : $dado[1];
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
            $novaEquipe->incluirEquipeAtende    = isset($incluirEquipeAtende) ? $incluirEquipeAtende : null;
            $novaEquipe->iconeEquipe            = isset($iconeEquipe) ? $iconeEquipe : null;
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
        $objDados = explode("&", str_replace('"', '', urldecode($request->data)));
        foreach ($objDados as $dado) {
            $dado = explode("=", $dado);
            switch ($dado[0]) {
                case 'codigoUnidadeEquipe':
                    $codigoUnidadeEquipe = $dado[1];
                    break;
                case 'nomeEquipe':
                    $encoding = mb_internal_encoding();
                    $nomeEquipe = mb_strtoupper($dado[1], $encoding);
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
                case 'incluirEquipeAtende':
                    $incluirEquipeAtende = $dado[1] = $dado[1] == '' ? null : $dado[1];
                    break;
                case 'iconeEquipe':
                    $iconeEquipe = $dado[1] = $dado[1] == '' ? null : $dado[1];
                    break;
            }
        }
        if ($idEquipe == '1') {
            return response('Não foi possível apagar a equipe alocação empregados', 500);
        }
        if (!isset($nomeEventual) || $nomeEventual == "" && $matriculaEventual !== "") {
            $eventual = Empregado::find($matriculaEventual);
            $nomeEventual = $eventual->nomeCompleto;
        }
        try {
            DB::beginTransaction();
            // SENSIBILIZA A EVENTUALIDADE NAS TABELAS ANTES DE PERSISTIR NA TABELA DE EQUIPE
            $editarEquipe = GestaoEquipesCelulas::find($idEquipe);
            if (isset($matriculaEventual)) {
                $matriculaAntigoEventual = strtolower($editarEquipe->matriculaEventual);
                if ($matriculaAntigoEventual != "" && !is_null($matriculaAntigoEventual) && $matriculaEventual !== "" && $matriculaAntigoEventual != $matriculaEventual) {
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
                }
                if($matriculaEventual !== "") {
                    // DESIGNA O EVENTUAL
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
            $editarEquipe->nomeEquipe               = !in_array($nomeEquipe, [null, 'NULL', '']) ? strtoupper($nomeEquipe) : $editarEquipe->nomeEquipe;
            $editarEquipe->matriculaGestor          = !in_array($matriculaGestor, [null, 'NULL', '']) ? $matriculaGestor : $editarEquipe->matriculaGestor;
            $editarEquipe->nomeGestor               = !in_array($nomeGestor, [null, 'NULL', '']) ? strtoupper($nomeGestor) : $editarEquipe->nomeGestor;
            $editarEquipe->matriculaEventual        = !in_array($matriculaEventual, [null, 'NULL', '']) ? $matriculaEventual : $editarEquipe->matriculaEventual;
            $editarEquipe->nomeEventual             = !in_array($nomeEventual, [null, 'NULL', '']) ? strtoupper($nomeEventual) : $editarEquipe->nomeEventual;
            if (isset($incluirEquipeAtende)) {
                $editarEquipe->incluirEquipeAtende      = !in_array($incluirEquipeAtende, [null, 'NULL', '']) ? $incluirEquipeAtende : $editarEquipe->incluirEquipeAtende;
            }
            if (isset($iconeEquipe)) {
                $editarEquipe->iconeEquipe              = !in_array($iconeEquipe, [null, 'NULL', '']) ? $iconeEquipe : $editarEquipe->iconeEquipe;
            }
            $editarEquipe->responsavelEdicao        = session('matricula');
            $editarEquipe->updated_at               = date("Y-m-d H:i:s", time());

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
            dd($th);
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

            // VERIFICA SE ELA É EVENTUAL DA EQUIPE ANTIGA
            $antigaEquipe = GestaoEquipesCelulas::find($empregadoAlocado->idEquipe);
            if (!is_null($antigaEquipe) && $antigaEquipe->matriculaEventual == $request->matricula) {
                $antigaEquipe->matriculaEventual    = null;
                $antigaEquipe->nomeEventual         = null;

                // REGISTRA O LOG DE HISTORICO DA AÇÃO
                $registroLogHistorico = new GestaoEquipesLogHistorico;
                $registroLogHistorico->idEquipe                 = $request->idEquipe;
                $registroLogHistorico->matriculaResponsavel     = session('matricula');
                $registroLogHistorico->tipo                     = 'DESTITUIÇÃO';
                $registroLogHistorico->observacao               = "DESTITUIÇÃO DA EVENTUALIDADE - EMPREGADO " . $empregadoAlocado->dadosEmpregadoLdap->nomeCompleto;
                $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
                $registroLogHistorico->save();

                $antigaEquipe->save();
            }

            $empregadoAlocado->idEquipe         = $request->idEquipe;
            $empregadoAlocado->eventualEquipe   = false;
            $empregadoAlocado->updated_at       = date("Y-m-d H:i:s", time());

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
        $objDados = explode("&", str_replace('"', '', $request->data));
        foreach ($objDados as $dado) {
            $dado = explode("=", $dado);
            switch ($dado[0]) {
                case 'idEquipe':
                    $idEquipe = $dado[1];
                    break;
                case 'ativa':
                    $ativa = $dado[1];
                    break;
                case 'nomeEquipe':
                    $encoding = mb_internal_encoding();
                    $nomeEquipe = mb_strtoupper($dado[1], $encoding);
                    break;
            }
        }

        if ($idEquipe == '1') {
            return response('Não foi possível apagar a equipe alocação empregados', 500);
        }
        
        try {
            DB::beginTransaction();
            // SENSIBILIZA A EVENTUALIDADE NAS TABELAS ANTES DE PERSISTIR NA TABELA DE EQUIPE
            $desativarEquipe = GestaoEquipesCelulas::find($idEquipe);
            $desativarEquipe->ativa        = $ativa;
            $desativarEquipe->updated_at   = date("Y-m-d H:i:s", time());

            // DEVOLVE TODOS OS EMPREGADOS DA EQUIPE DESABILITADA PARA A EQUIPE DE ALOCAR
            $empregadosEquipeDesativada = GestaoEquipesEmpregados::where('idEquipe', $idEquipe)->get();
            foreach ($empregadosEquipeDesativada as $empregado) {
                $empregado->idEquipe        = null;
                $empregado->eventualEquipe  = false;
                $empregado->updated_at      = date("Y-m-d H:i:s", time());
                $empregado->save();
            }

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'DESATIVAR';
            $registroLogHistorico->observacao               = "DESATIVAÇÃO DA EQUIPE " . $nomeEquipe;
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

    public static function incluirEmpregadoNoArrayDaEquipe($arrayEmpregadosEquipe, $objetoGestaoEquipesEmpregados) {
        $nomeCompleto = is_null($objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeCompleto) ? '' : ucwords(strtolower((string) $objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeCompleto));
        array_push($arrayEmpregadosEquipe, [
            'matricula'     => $objetoGestaoEquipesEmpregados->matricula,
            'nomeCompleto'  => strtoupper($nomeCompleto),
            'nomeFuncao'    => is_null($objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeFuncao) ? 'TECNICO BANCARIO NOVO' : $objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeFuncao,
        ]);
        return $arrayEmpregadosEquipe;
    }

    public static function incluirEquipeNoArray($arrayEquipes, $objGestaoEquipesCelulas, $arrayEmpregadosEquipe){
        $nomeGestor = is_null($objGestaoEquipesCelulas->nomeGestor) ? '' : ucwords(strtolower((string) $objGestaoEquipesCelulas->nomeGestor));
        array_push($arrayEquipes, [
            'idEquipe'                  => (string) $objGestaoEquipesCelulas->idEquipe,
            'nomeEquipe'                => $objGestaoEquipesCelulas->nomeEquipe,
            'nomeGestorEquipe'          => $nomeGestor,
            'matriculaGestorEquipe'     => $objGestaoEquipesCelulas->matriculaGestor,
            'nomeEventualEquipe'        => $objGestaoEquipesCelulas->nomeEventual,
            'matriculaEventualEquipe'   => $objGestaoEquipesCelulas->matriculaEventual,
            'empregadosEquipe'          => $arrayEmpregadosEquipe
        ]);
        return $arrayEquipes;
    }

    public static function listaGestoresUnidade($codigoUnidade)
    {
        $listaGestoresUnidade = Empregado::where(function($lotacao) use($codigoUnidade) {
            $lotacao->where('codigoLotacaoAdministrativa', $codigoUnidade)
                    ->orWhere('codigoLotacaoFisica', $codigoUnidade);   
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
}
