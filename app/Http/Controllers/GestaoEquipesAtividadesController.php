<?php

namespace App\Http\Controllers;

use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Models\GestaoEquipesAtividades;
use App\Models\GestaoEquipesAtividadesResponsaveis;
use App\Models\GestaoEquipesCelulas;
use App\Models\GestaoEquipesLogHistorico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $equipesUnidade = GestaoEquipesCelulas::where('codigoUnidadeEquipe', $codigoUnidade)->where('ativa', true)->get();
        // dd($equipesUnidade);
        $arrayAtividadesEquipe = [];
        $arrayEquipesComAtividadesResponsaveis = [];
        foreach ($equipesUnidade as $equipe) {
            if ($equipe->GestaoEquipesAtividades->count() > 0) {
                foreach ($equipe->GestaoEquipesAtividades as $atividade) {
                    if ($atividade->atividadeSubordinada == false) {
                        $arrayAtividadesSubordinadas = self::listaAtividadesSubordinadas($atividade->idAtividade);
                        $listaResponsaveisAtividade = self::listarResponsaveisAtividade($atividade->idAtividade);
                        array_push($arrayAtividadesEquipe, [
                            'idAtividade'               => $atividade->idAtividade,
                            'nomeAtividade'             => $atividade->nomeAtividade,
                            'sinteseAtividade'          => $atividade->sinteseAtividade,
                            'atividadesSubordinadas'    => $arrayAtividadesSubordinadas,
                            'responsaveisAtividade'     => $listaResponsaveisAtividade,
                        ]);
                    }
                }
                if (count($arrayAtividadesEquipe) > 0) {
                    array_push($arrayEquipesComAtividadesResponsaveis, [(string) $equipe->idEquipe => $arrayAtividadesEquipe]);
                    $arrayAtividadesEquipe = [];
                }
            }
        }
        return json_encode($arrayEquipesComAtividadesResponsaveis);
    }

    public static function listaAtividadesSubordinadas($idAtividadeSubordinante) {
        $arrayAtividadesSubordinadas = [];
        $listaAtividadesSubordinadas = GestaoEquipesAtividades::where('idAtividadeSubordinante', $idAtividadeSubordinante)->where('atividadeAtiva', true)->get();
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
                'idResponsavelAtividade'    => $responsavelAtividade->idResponsavelAtividade,
                'matricula'                 => $responsavelAtividade->matricula,
                // 'nomeCompleto'  => $nomeCompleto,
                // 'nomeFuncao'    => is_null($responsavelAtividade->dadosEmpregadoLdap->nomeFuncao) ? 'TECNICO BANCARIO NOVO' : $responsavelAtividade->dadosEmpregadoLdap->nomeFuncao,
            ]);
        }
        return $listaResponsaveisAtividade;
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarAtividade(Request $request)
    {
        $objDados = explode("&", str_replace('"', '', urldecode($request->data)));
        foreach ($objDados as $dado) {
            $dado = explode("=", $dado);
            switch ($dado[0]) {
                case 'idEquipe':
                    $idEquipe = $dado[1];
                case 'atividadeSubordinada':
                    $atividadeSubordinada = $dado[1];
                    break;
                case 'nomeAtividade':
                    $encoding = mb_internal_encoding();
                    $nomeAtividade = mb_strtoupper($dado[1], $encoding);
                    break;
                case 'sinteseAtividade':
                    $encoding = mb_internal_encoding();
                    $sinteseAtividade = mb_strtoupper($dado[1], $encoding);
                    break;
                case 'prazoAtendimento':
                    $prazoAtendimento = $dado[1];
                    break;
                case 'idAtividadeSubordinante':
                    $idAtividadeSubordinante = $dado[1] == '' ? null : $dado[1];
                    break;
            }
        }

        try {
            DB::beginTransaction();
            // CRIA A NOVA ATIVIDADE
            $novaAtividade = new GestaoEquipesAtividades;
            $novaAtividade->idEquipe                    = $idEquipe;
            $novaAtividade->nomeAtividade               = strtoupper($nomeAtividade);
            $novaAtividade->sinteseAtividade            = $sinteseAtividade;
            $novaAtividade->atividadeSubordinada        = $atividadeSubordinada;
            $novaAtividade->idAtividadeSubordinante     = isset($idAtividadeSubordinante) ? $idAtividadeSubordinante : null;
            $novaAtividade->prazoAtendimento            = $prazoAtendimento;
            $novaAtividade->responsavelEdicao           = session('matricula');
            $novaAtividade->dataCriacaoAtividade        = date("Y-m-d H:i:s", time());
            $novaAtividade->dataAtualizacaoAtividade    = date("Y-m-d H:i:s", time());
            $novaAtividade->save();

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'CADASTRO';
            $registroLogHistorico->observacao               = "CADASTRO DA ATIVIDADE " . strtoupper($nomeAtividade);
            $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
            $registroLogHistorico->save();

            DB::commit();
            return response('atividade cadastrada com sucesso', 200);
        } catch (\Throwable $th) {
            dd($th);
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
    public function editarAtividade(Request $request, $idAtividade)
    {
        $objDados = explode("&", str_replace('"', '', urldecode($request->data)));
        foreach ($objDados as $dado) {
            $dado = explode("=", $dado);
            switch ($dado[0]) {
                case 'prazoAtendimento':
                    $prazoAtendimento = $dado[1];
                    break;
                case 'nomeAtividade':
                    $encoding = mb_internal_encoding();
                    $nomeAtividade = mb_strtoupper($dado[1], $encoding);
                    break;
                case 'sinteseAtividade':
                    $encoding = mb_internal_encoding();
                    $sinteseAtividade = mb_strtoupper($dado[1], $encoding);
                    break;
            }
        }
        // dd(['objDados' => $objDados, 'prazoAtendimento' => $prazoAtendimento, 'nomeAtividade' => $nomeAtividade, 'sinteseAtividade' => $sinteseAtividade]);
        try {
            DB::beginTransaction();
            $editarAtividade = GestaoEquipesAtividades::find($idAtividade);
            
            // VALIDA SE EXISTEM DADOS PARA SEREM ALTERADOS, CASO NEGATIVO RETORNA COM ERRO PARA A VIEW
            if ($editarAtividade->nomeAtividade == $nomeAtividade && $editarAtividade->sinteseAtividade == $sinteseAtividade && $editarAtividade->prazoAtendimento == $prazoAtendimento) {
                return response('Não existem dados para serem alterados', 500);
            }

            // EDITAR EQUIPE
            $editarAtividade->nomeAtividade             = !in_array($nomeAtividade, [null, 'NULL', '']) ? strtoupper($nomeAtividade) : $editarAtividade->nomeAtividade;
            $editarAtividade->sinteseAtividade          = !in_array($sinteseAtividade, [null, 'NULL', '']) ? $sinteseAtividade : $editarAtividade->sinteseAtividade;
            $editarAtividade->responsavelEdicao         = session('matricula');
            $editarAtividade->prazoAtendimento          = !in_array($prazoAtendimento, [null, 'NULL', '']) ? $prazoAtendimento : $editarAtividade->prazoAtendimento;
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
     * Remove the specified resource from storage.
     *
     * @param  int  $idAtividade
     * @return \Illuminate\Http\Response
     */
    public function desativarAtividade($idAtividade)
    {               
        try {
            DB::beginTransaction();
            // DESABILITA A ATIVIDADE
            $desativarAtividade = GestaoEquipesAtividades::find($idAtividade);
            $desativarAtividade->atividadeAtiva             = false;
            $desativarAtividade->responsavelEdicao          = session('matricula');
            $desativarAtividade->dataAtualizacaoAtividade   = date("Y-m-d H:i:s", time());

            // DESATIVA TODOS OS EMPREGADOS DA ATIVIDADE DESABILITADA 
            $empregadosAtividadeDesativada = GestaoEquipesAtividadesResponsaveis::where('idAtividade', $idAtividade)->get();
            foreach ($empregadosAtividadeDesativada as $empregado) {
                $empregado->atuandoAtividade                = false;
                $empregado->matriculaResponsavelDesignacao  = session('matricula');
                $empregado->dataAtualizacao                 = date("Y-m-d H:i:s", time());
                $empregado->save();
            }

            // REGISTRA O LOG DE HISTORICO DA AÇÃO
            $registroLogHistorico = new GestaoEquipesLogHistorico;
            $registroLogHistorico->idEquipe                 = $desativarAtividade->GestaoEquipesCelulas->idEquipe;
            $registroLogHistorico->matriculaResponsavel     = session('matricula');
            $registroLogHistorico->tipo                     = 'DESATIVAR';
            $registroLogHistorico->observacao               = "DESATIVAÇÃO DA ATIVIDADE " . $desativarAtividade->nomeAtividade;
            $registroLogHistorico->dataLog                  = date("Y-m-d H:i:s", time());
            $registroLogHistorico->save();

            $desativarAtividade->save();
            DB::commit();
            return response('atividade apagada com sucesso', 200);
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            return response('Não foi possível apagar a atividade', 500);
        }
    }

    /**
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function designarEmpregadoAtividade(Request $request)
    {
        // $objDados = explode("&", str_replace('"', '', urldecode($request->data)));
        // foreach ($objDados as $dado) {
        //     $dado = explode("=", $dado);
        //     switch ($dado[0]) {
        //         case 'idAtividade':
        //             $idAtividade = $dado[1];
        //         case 'matriculaResponsavelAtividade':
        //             $matriculaResponsavelAtividade = $dado[1];
        //             break;
        //         case 'atuandoAtividade':
        //             $atuandoAtividade = $dado[1];
        //             break;
        //     }
        // }
        
        try {
            DB::beginTransaction();
            // DESIGNAR EMPREGADO
            $empregadoDesignado = GestaoEquipesAtividadesResponsaveis::firstOrNew(array('idAtividade' => $request->idAtividade, 'matriculaResponsavelAtividade', $request->matriculaResponsavelAtividade))->first();
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
}
