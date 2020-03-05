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
     * Display a listing of the resource.
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
        $arrayEquipesParaJson = [];
        $arrayEquipesUnidade = [];
        $relacaoEquipesUnidade = GestaoEquipesCelulas::where('ativa', true)->where('codigoUnidadeEquipe', session('codigoLotacaoAdministrativa'))->orWhere('codigoUnidadeEquipe', null)->get();
        foreach ($relacaoEquipesUnidade as $equipe) {
            if (is_null($equipe->codigoUnidadeEquipe)) {
                $relacaoEmpregadosNaoAlocados = GestaoEquipesEmpregados::where('idEquipe', null)->where(function($lotacao) {
                    $lotacao->where('codigoUnidadeLotacao', session('codigoLotacaoAdministrativa'))
                            ->orWhere('codigoUnidadeLotacao', session('codigoLotacaoFisica'));
                    })->get();
                $arrayEmpregadosNaoAlocados = [];
                foreach ($relacaoEmpregadosNaoAlocados as $empregadoNaoAlocado) {
                    $arrayEmpregadosNaoAlocados = self::incluirEmpregadoNaEquipe($arrayEmpregadosNaoAlocados, $empregadoNaoAlocado);
                }
                array_push($arrayEquipesParaJson, array('empregadosParaAlocar' => [
                    'idEquipe'                  => (string) $equipe->idEquipe,
                    'nomeEquipe'                => $equipe->nomeEquipe,
                    'nomeGestorEquipe'          => $equipe->nomeGestor,
                    'matriculaGestorEquipe'     => $equipe->matriculaGestor,
                    'nomeEventualEquipe'        => $equipe->nomeEventual,
                    'matriculaEventualEquipe'   => $equipe->matriculaEventual,
                    'empregadosEquipe'          => $arrayEmpregadosNaoAlocados
                ]));
            } else {
                $relacaoEmpregadosEquipe = GestaoEquipesEmpregados::where('idEquipe', $equipe->idEquipe)->get();
                $arrayEmpregadosEquipe = [];
                foreach ($relacaoEmpregadosEquipe as $empregadoEquipe) {
                    $arrayEmpregadosEquipe = self::incluirEmpregadoNaEquipe($arrayEmpregadosEquipe, $empregadoEquipe);
                }
                array_push($arrayEquipesUnidade, [
                    'idEquipe'                  => (string) $equipe->idEquipe,
                    'nomeEquipe'                => $equipe->nomeEquipe,
                    'nomeGestorEquipe'          => $equipe->nomeGestor,
                    'matriculaGestorEquipe'     => $equipe->matriculaGestor,
                    'nomeEventualEquipe'        => $equipe->nomeEventual,
                    'matriculaEventualEquipe'   => $equipe->matriculaEventual,
                    'empregadosEquipe'          => $arrayEmpregadosEquipe
                ]);
            }
        }
        array_push($arrayEquipesParaJson, array((string) $equipe->codigoUnidadeEquipe => $arrayEquipesUnidade));
        return json_encode($arrayEquipesParaJson);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarEquipe(Request $request)
    {
        dd($request);
        try {
            DB::beginTransaction();
            // CRIA A NOVA EQUIPE
            $novaEquipe = new GestaoEquipesCelulas;
            $novaEquipe->codigoUnidadeEquipe    = !in_array(session('codigoLotacaoFisica'), [null, 'NULL']) ? session('codigoLotacaoFisica') : session('codigoLotacaoAdministrativa');
            $novaEquipe->nomeEquipe             = strtoupper($request->nomeEquipe);
            $novaEquipe->matriculaGestor        = isset($request->matriculaGestor) ? $request->matriculaGestor : null;
            $novaEquipe->nomeGestor             = isset($request->nomeGestor) ? $request->nomeGestor : null;
            $novaEquipe->matriculaEventual      = isset($request->matriculaEventual) ? $request->matriculaEventual : null;
            $novaEquipe->nomeEventual           = isset($request->nomeEventual) ? $request->nomeEventual : null;
            $novaEquipe->responsavelEdicao      = session('matricula');
            $novaEquipe->created_at             = date("Y-m-d H:i:s", time());
            $novaEquipe->updated_at             = date("Y-m-d H:i:s", time());
            $novaEquipe->save();

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $novaEquipe->idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'CADASTRO';
            $registroLogHistorico->observacao               = "CADASTRO DA EQUIPE " . strtoupper($request->nomeEquipe);
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
        dd($request);
        try {
            DB::beginTransaction();
            // SENSIBILIZA A EVENTUALIDADE NAS TABELAS ANTES DE PERSISTIR NA TABELA DE EQUIPE
            $editarEquipe = GestaoEquipesCelulas::find($request->idEquipe);
            if (isset($request->matriculaEventual)) {
                $matriculaAntigoEventual = $editarEquipe->matriculaEventual;
                if (!is_null($matriculaAntigoEventual)) {
                    // REMOVE O ANTIGO EVENTUAL
                    $antigoEventual = GestaoEquipesEmpregados::find($matriculaAntigoEventual);
                    $antigoEventual->eventualEquipe = false;
                    $antigoEventual->updated_at = date("Y-m-d H:i:s", time());

                    // REGISTRA O LOG DE HISTORICO DA AÇÃO
                    $registroLogHistorico = new GestaoEquipesLogHistorico;
                    $registroLogHistorico->idEquipe                 = $request->idEquipe;
                    $registroLogHistorico->matriculaResponsavel     = session('matricula');
                    $registroLogHistorico->tipo                     = 'EDIÇÃO';
                    $registroLogHistorico->observacao               = "REMOÇÃO DA EVENTUALIDADE - " . $antigoEventual->dadosEmpregadoLdap->nomeCompleto;
                    $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
                    $registroLogHistorico->save();

                    $antigoEventual->save();

                    // DESIGNA O ANTIGO EVENTUAL
                    $novoEventual = GestaoEquipesEmpregados::find($request->matriculaEventual);
                    $novoEventual->eventualEquipe = true;
                    $novoEventual->updated_at = date("Y-m-d H:i:s", time());
                    
                    // REGISTRA O LOG DE HISTORICO DA AÇÃO
                    $registroLogHistorico = new GestaoEquipesLogHistorico;
                    $registroLogHistorico->idEquipe                 = $request->idEquipe;
                    $registroLogHistorico->matriculaResponsavel     = session('matricula');
                    $registroLogHistorico->tipo                     = 'EDIÇÃO';
                    $registroLogHistorico->observacao               = "DESIGNAÇÃO DE EVENTUALIDADE - " . $novoEventual->dadosEmpregadoLdap->nomeCompleto;
                    $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
                    $registroLogHistorico->save();

                    $novoEventual->save();
                }
            }

            // EDITAR EQUIPE
            $editarEquipe->nomeEquipe             = !in_array($request->nomeEquipe, [null, 'NULL']) ? strtoupper($request->nomeEquipe) : $editarEquipe->nomeEquipe;
            $editarEquipe->matriculaGestor        = !in_array($request->matriculaGestor, [null, 'NULL']) ? strtoupper($request->matriculaGestor) : $editarEquipe->matriculaGestor;
            $editarEquipe->nomeGestor             = !in_array($request->nomeGestor, [null, 'NULL']) ? strtoupper($request->nomeGestor) : $editarEquipe->nomeGestor;
            $editarEquipe->matriculaEventual      = !in_array($request->matriculaEventual, [null, 'NULL']) ? strtoupper($request->matriculaEventual) : $editarEquipe->matriculaEventual;
            $editarEquipe->nomeEventual           = !in_array($request->nomeEventual, [null, 'NULL']) ? strtoupper($request->nomeEventual) : $editarEquipe->nomeEventual;
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
        dd($request);
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
            'nomeFuncao'    => $objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeFuncao,
        ]);
        return $arrayEmpregadosEquipe;
    }
}
