<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestaoEquipesAtividades;
use App\Models\GestaoEquipesAtividadesResponsaveis;
use App\Models\GestaoEquipesCelulas;

class GestaoEquipesAtividadesController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.gerencial.atividades');
    }

    /**
     * 
     * @return \Illuminate\Http\Response
     */
    public function listarAtividadesComResponsaveis($codigoUnidade)
    {
        $arrayEquipesComAtividadesResponsaveis = [];
        $equipesUnidade = GestaoEquipesCelulas::where('codigoUnidadeEquipe', $codigoUnidade)->where('ativa', true)->get();
        foreach ($equipesUnidade as $equipe) {
            $arrayAtividadesEquipe = [];
            if ($equipe->GestaoEquipesAtividades->count() > 0) {
                foreach ($equipe->GestaoEquipesAtividades as $atividade) {
                    if ($atividade->atividadeSubordinada) {
                        $arrayAtividadesSubordinadas = self::listaAtividadesSubordinadas($atividade->atividadeSubordinada->idAtividade);
                        array_push($arrayAtividadesEquipe, [
                            'idAtividade'               => $atividade->idAtividade,
                            'nomeAtividade'             => $atividade->nomeAtividade,
                            'sinteseAtividade'          => $atividade->sinteseAtividade,
                            'atividadesSubordinadas'    => $arrayAtividadesSubordinadas,
                        ]);
                    } else {
                        $listaResponsaveisAtividade = self::listarResponsaveisAtividade($atividade->idAtividade);
                        array_push($arrayAtividadesEquipe, [
                            'idAtividade'               => $atividade->idAtividade,
                            'nomeAtividade'             => $atividade->nomeAtividade,
                            'sinteseAtividade'          => $atividade->sinteseAtividade,
                            'atividadesSubordinadas'    => null,
                            'responsaveisAtividade'     => $listaResponsaveisAtividade,
                        ]);
                    }
                }
            }
            if (count($arrayAtividadesEquipe) > 0) {
                array_push($arrayEquipesComAtividadesResponsaveis, array((string) $equipe->idEquipe, $arrayAtividadesEquipe));
            }
        }
        return json_encode($arrayEquipesComAtividadesResponsaveis);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarAtividade(Request $request)
    {
        try {
            DB::beginTransaction();
            // CRIA A NOVA ATIVIDADE
            $novaAtividade = new GestaoEquipesAtividades;
            $novaAtividade->idEquipe                    = $request->idEquipe;
            $novaAtividade->nomeAtividade               = strtoupper($request->nomeAtividade);
            $novaAtividade->sinteseAtividade            = $request->sinteseAtividade;
            $novaAtividade->atividadeSubordinada        = $request->atividadeSubordinada;
            $novaAtividade->idAtividadeSubordinante     = isset($request->atividadeSubordinada) ? $request->atividadeSubordinada : null;
            $novaAtividade->dataCriacaoAtividade        = date("Y-m-d H:i:s", time());
            $novaAtividade->dataAtualizacaoAtividade    = date("Y-m-d H:i:s", time());
            $novaAtividade->save();

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $request->idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'CADASTRO';
            $registroLogHistorico->observacao               = "CADASTRO DA ATIVIDADE " . strtoupper($request->nomeAtividade);
            $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
            $registroLogHistorico->save();

            DB::commit();
            return response('atividade cadastrada com sucesso', 200);
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            return response('Não foi possível cadastrar a atividade', 500);
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

    public static function listaAtividadesSubordinadas($idAtividadeSubordinante) {
        $arrayAtividadesSubordinadas = [];
        $listaAtividadesSubordinadas = GestaoEquipesAtividades::where('idAtividadeSubordinante', $idAtividadeSubordinante)->get();
        foreach ($listaAtividadesSubordinadas as $atividadeSubordinada) {
            $listaResponsaveisAtividade = self::listarResponsaveisAtividade($atividadeSubordinada->idAtividade);
            array_push($arrayAtividadesSubordinadas, [
                'idAtividade'           => $atividadeSubordinada->idAtividade,
                'nomeAtividade'         => $atividadeSubordinada->nomeAtividade,
                'sinteseAtividade'      => $atividadeSubordinada->sinteseAtividade,
                'responsaveisAtividade' => $listaResponsaveisAtividade,
            ]);
        }
        return $arrayAtividadesSubordinadas;
    }

    public static function listarResponsaveisAtividade($idAtividade) {
        $listaResponsaveisAtividade = [];
        $arrayResponsaveisAtividade = GestaoEquipesAtividadesResponsaveis::where('idAtividade', $idAtividade)->where('atuandoAtividade', true)->get();
        foreach ($arrayResponsaveisAtividade as $responsavelAtividade) {
            // $nomeCompleto = is_null($responsavelAtividade->dadosEmpregadoLdap->nomeCompleto) ? '' : ucwords(strtolower((string) $responsavelAtividade->dadosEmpregadoLdap->nomeCompleto));
            array_push($listaResponsaveisAtividade, [
                'matricula'     => $responsavelAtividade->matricula,
                // 'nomeCompleto'  => $nomeCompleto,
                // 'nomeFuncao'    => is_null($responsavelAtividade->dadosEmpregadoLdap->nomeFuncao) ? 'TECNICO BANCARIO NOVO' : $responsavelAtividade->dadosEmpregadoLdap->nomeFuncao,
            ]);
        }
        return $listaResponsaveisAtividade;
    }
}
