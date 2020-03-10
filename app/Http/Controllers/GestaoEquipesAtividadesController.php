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
            $novaAtividade->responsavelEdicao           = session('matricula');
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idAtividade
     * @return \Illuminate\Http\Response
     */
    public function editarAtividade(Request $request, $id)
    {
        $objDados = explode("&", str_replace('"', '', urldecode($request->data)));
        foreach ($objDados as $dado) {
            $dado = explode("=", $dado);
            switch ($dado[0]) {
                case 'idEquipe':
                    $idEquipe = $dado[1];
                case 'nomeAtividade':
                    $nomeAtividade = $dado[1];
                    break;
                case 'sinteseAtividade':
                    $sinteseAtividade = $dado[1];
                    break;
                case 'atividadeSubordinada':
                    $atividadeSubordinada = $dado[1];
                    break;
                case 'idAtividadeSubordinante':
                    $idAtividadeSubordinante = $dado[1];
                    break;
            }
        }
        if ($idEquipe == '1') {
            return response('Não é possível cadastrar atividade para essa equipe', 500);
        }

        try {
            DB::beginTransaction();
            // SENSIBILIZA A EVENTUALIDADE NAS TABELAS ANTES DE PERSISTIR NA TABELA DE EQUIPE
            $editarAtividade = GestaoEquipesAtividades::find($idEquipe);

            // EDITAR EQUIPE
            $editarAtividade->nomeAtividade             = !in_array($nomeAtividade, [null, 'NULL', '']) ? strtoupper($nomeAtividade) : $editarAtividade->nomeAtividade;
            $editarAtividade->sinteseAtividade          = !in_array($sinteseAtividade, [null, 'NULL', '']) ? $sinteseAtividade : $editarAtividade->sinteseAtividade;
            $editarAtividade->atividadeSubordinada      = !in_array($atividadeSubordinada, [null, 'NULL', '']) ? strtoupper($atividadeSubordinada) : $editarAtividade->atividadeSubordinada;
            $editarAtividade->idAtividadeSubordinante   = !in_array($idAtividadeSubordinante, [null, 'NULL', '']) ? $idAtividadeSubordinante : $editarAtividade->idAtividadeSubordinante;
            $editarAtividade->responsavelEdicao         = session('matricula');
            $editarAtividade->dataAtualizacaoAtividade  = date("Y-m-d H:i:s", time());

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $editarAtividade->idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'EDIÇÃO';
            $registroLogHistorico->observacao               = "EDIÇÃO DOS DADOS DA ATIVIDADE " . strtoupper($editarAtividade->nomeAtividade);
            $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
            $registroLogHistorico->save();

            $editarAtividade->save();
            DB::commit();
            return response('Atividade editada com sucesso', 200);
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            return response('Não foi possível editar a atividade', 500);
        }
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idResponsavelAtividade
     * @return \Illuminate\Http\Response
     */
    public function designarEmpregadoAtividade(Request $request, $idResponsavelAtividade)
    {
        try {
            DB::beginTransaction();
            // DESIGNAR EMPREGADO
            $empregadoDesignado = GestaoEquipesAtividadesResponsaveis::firstOrNew(array('idResponsavelAtividade' => $idResponsavelAtividade));
            $empregadoDesignado->idAtividade                        = $request->idAtividade;
            $empregadoDesignado->matriculaResponsavelAtividade      = $request->matriculaResponsavelAtividade;
            $empregadoDesignado->atuandoAtividade                   = $request->atuandoAtividade;
            $empregadoDesignado->matriculaResponsavelDesignacao     = session('matricula');
            $empregadoDesignado->dataCadastro                       = is_null($empregadoDesignado->dataCadastro) ? date("Y-m-d H:i:s", time()) : $empregadoDesignado->dataCadastro;
            $empregadoDesignado->dataAtualizacao                    = date("Y-m-d H:i:s", time());

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $request->idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'ALOCAÇÃO';
            $registroLogHistorico->observacao               = "ALOCAÇÃO DO EMPREGADO " . $empregadoDesignado->dadosEmpregadoLdap->nomeCompleto;
            $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
            $registroLogHistorico->save();

            $empregadoDesignado->save();
            DB::commit();
            return response('empregado designado com sucesso', 200);
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            return response('Não foi possível designar o empregado', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function desativarAtividade($id)
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
