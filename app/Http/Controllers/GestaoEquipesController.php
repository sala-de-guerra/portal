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
        // /* 
        //     VALIDA O CODIGO DA FUNÇÃO DO EMPREGADO DA SESSÃO SE É GERENTE
        //     CASO POSITIVO VERIFICA SE EXISTE ALGUMA EQUIPE EXISTENTE NA UNIDADE OU 
        //     CASO NEGATIVO CRIA A PRIMEIRA PARA GESTÃO DO GESTOR
        // */
        // $usuarioGestor = Empregado::find(session('matricula'));

        // if($usuarioGestor->codigoFuncao == '2066') {
        //     $quantidadeEquipes = GestaoEquipesCelulas::where('codigoUnidadeEquipe', $usuarioGestor->codigoLotacaoAdministrativa)->get();
        //     if ($quantidadeEquipes->count() == 0) {
        //         $primeiraEquipeUnidade = new GestaoEquipesCelulas;
        //         $primeiraEquipeUnidade->codigoUnidadeEquipe = $usuarioGestor->codigoLotacaoAdministrativa;
        //         $primeiraEquipeUnidade->nomeEquipe = 'Gerencial';
        //         $primeiraEquipeUnidade->matriculaGestor = $usuarioGestor->matricula;
        //         $primeiraEquipeUnidade->nomeGestor = $usuarioGestor->nomeCompleto;
        //         $primeiraEquipeUnidade->created_at = date("Y-m-d H:i:s", time());
        //         $primeiraEquipeUnidade->updated_at = date("Y-m-d H:i:s", time());
        //         $primeiraEquipeUnidade->save();
        //     }
        // }
        return view('portal.gerencial.equipes');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function listarEquipesUnidade()
    {
        $arrayTratadoEquipes = [];
        $relacaoEquipesUnidade = GestaoEquipesCelulas::where('ativa', true)->where('codigoUnidadeEquipe', session('codigoLotacaoAdministrativa'))->orWhere('codigoUnidadeEquipe', null)->get();
        foreach ($relacaoEquipesUnidade as $equipe) {
            if (is_null($equipe->codigoUnidadeEquipe)) {
                $relacaoEmpregadosNaoAlocados = GestaoEquipesEmpregados::where('idEquipe', null)->where(function($lotacao) {
                    $lotacao->where('codigoUnidadeLotacao', session('codigoLotacaoAdministrativa'))
                            ->orWhere('codigoUnidadeLotacao', session('codigoLotacaoFisica'));
                    })->get();
                $arrayEmpregadosNaoAlocados = [];
                foreach ($relacaoEmpregadosNaoAlocados as $empregadoNaoAlocado) {
                    array_push($arrayEmpregadosNaoAlocados, [
                        'matricula'     => $empregadoNaoAlocado->matricula,
                        'nomeCompleto'  => $empregadoNaoAlocado->dadosEmpregadoLdap->nomeCompleto,
                        'nomeFuncao'    => $empregadoNaoAlocado->dadosEmpregadoLdap->nomeFuncao,
                    ]);
                }
                array_push($arrayTratadoEquipes, array('empregadosParaAlocar' => [
                    'idEquipe'          => (string) $equipe->idEquipe,
                    'nomeEquipe'        => $equipe->nomeEquipe,
                    'empregadosEquipe'  => $arrayEmpregadosNaoAlocados
                ]));
            } else {
                $relacaoEmpregadosEquipe = GestaoEquipesEmpregados::where('idEquipe', $equipe->idEquipe)->get();
                $arrayEmpregadosEquipe = [];
                foreach ($relacaoEmpregadosEquipe as $empregadoEquipe) {
                    array_push($arrayEmpregadosEquipe, [
                        'matricula'     => $empregadoEquipe->matricula,
                        'nomeCompleto'  => $empregadoEquipe->dadosEmpregadoLdap->nomeCompleto,
                        'nomeFuncao'    => $empregadoEquipe->dadosEmpregadoLdap->nomeFuncao,
                    ]);
                }
                array_push($arrayTratadoEquipes, array((string) $equipe->codigoUnidadeEquipe => [
                    'idEquipe'                  => (string) $equipe->idEquipe,
                    'nomeEquipe'                => $equipe->nomeEquipe,
                    'nomeGestorEquipe'          => $equipe->nomeGestor,
                    'matriculaGestorEquipe'     => $equipe->matriculaGestor,
                    'nomeEventualEquipe'        => $equipe->nomeEventual,
                    'matriculaEventualEquipe'   => $equipe->matriculaEventual,
                    'empregadosEquipe'          => $arrayEmpregadosEquipe
                ]));
            }
        }
        return json_encode($arrayTratadoEquipes);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarEquipe(Request $request)
    {
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
