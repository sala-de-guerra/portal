<?php

namespace App\Http\Controllers;

use App\Classes\DiasUteisClass;
use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\GestaoEquipesAtividadesController;
use App\Models\Atende;
use App\Models\BaseSimov;
use App\Models\GestaoEquipesAtividades;
use App\Models\GestaoEquipesAtividadesResponsaveis;
use App\Models\GestaoEquipesCelulas;
use App\Models\GestaoEquipesLogHistorico;
use App\Models\HistoricoPortalGilie;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AtendeDemandasController extends Controller
{
    /**
     *
     * @param  int  $idAtende
     * @return \Illuminate\Http\Response
     */
 
    public function listarDadosDemandaAtende($idAtende)
    {
        $dadosAtende = Atende::find($idAtende);

        return json_encode([
            'idAtende' => $dadosAtende->idAtende,
            'idEquipe' => $dadosAtende->idEquipe,
            'nomeEquipe' => $dadosAtende->gestaoEquipeCelulas->nomeEquipe,
            'idAtividade' => $dadosAtende->idAtividade,
            'nomeAtividade' => $dadosAtende->gestaoEquipesAtividades->nomeAtividade,
            'contratoFormatado' => $dadosAtende->contratoFormatado,
            'numeroContrato' => $dadosAtende->numeroContrato,
            'assuntoAtende' => $dadosAtende->assuntoAtende,
            'descricaoAtende' => $dadosAtende->descricaoAtende,
        ]);
    }

    public function viewMinhasDemandas()
    {
        return view ('portal.atende.minhas-demandas');
        
    }
    public function viewGerenciarDemandas()
    {
        return view('portal.gerencial.gestao-atende');
        
    }
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function listarAtendesDisponiveisResponsavel()
    {
        $listaDemandasAtende = Atende::where('matriculaResponsavelAtividade', session('matricula'))->where('statusAtende', '!=', 'FINALIZADO')->get();
        $arrayDemandasResponsavel = [];
        if (!$listaDemandasAtende->isEmpty()) {
            foreach ($listaDemandasAtende as $demanda) {
                $dadosMacroAtividade = GestaoEquipesAtividades::find($demanda->gestaoEquipesAtividades->idAtividadeSubordinante);
                array_push($arrayDemandasResponsavel, [
                    'idAtende'                  => $demanda->idAtende,
                    'idEquipe'                  => $demanda->idEquipe,
                    'nomeEquipe'                => $demanda->gestaoEquipeCelulas->nomeEquipe,
                    'idMacroAtividade'          => $demanda->gestaoEquipesAtividades->idAtividadeSubordinante,
                    'nomeMacroAtividade'        => $dadosMacroAtividade !== null ? $dadosMacroAtividade->nomeAtividade : null,
                    'idAtividade'               => $demanda->idAtividade,
                    'nomeAtividade'             => $demanda->gestaoEquipesAtividades->nomeAtividade,
                    'contratoFormatado'         => $demanda->contratoFormatado,
                    'numeroContrato'            => $demanda->numeroContrato,
                    'assuntoAtende'             => $demanda->assuntoAtende,
                    'descricaoAtende'           => $demanda->descricaoAtende,
                    'prazoAtendimentoAtende'    => $demanda->prazoAtendimentoAtende,
                ]);
            }
        }
        return json_encode($arrayDemandasResponsavel);
    }

    public function listarEquipesComAtividadesAtende()
    {
        try {
            DB::beginTransaction();
            $arrayEquipesComAtividadesAtende = [];
            $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
            // $unidadeUsuario = '7257';

            // LISTAR EQUIPES
            $listaEquipes = GestaoEquipesCelulas::where('ativa', true)->where('codigoUnidadeEquipe', $unidadeUsuario)->where('incluirEquipeAtende', true)->get();
            foreach ($listaEquipes as $equipe) {
                $arrayAtividadesEquipe = [];
                // LISTAR MACROATIVIDADES
                $listaMacroAtividadesEquipe = GestaoEquipesAtividades::where('idEquipe', $equipe->idEquipe)->where('atividadeAtiva', true)->where('incluirAtividadeAtende', true)->get();
                foreach ($listaMacroAtividadesEquipe as $macroAtividade) {
                    if ($macroAtividade->atividadeSubordinada == false) {
                        if ($macroAtividade->idAtividadeSubordinante == null) {
                            // LISTAR MICROATIVIDADES
                            $arrayMicroAtividades = self::listaMicroAtividades($macroAtividade->idAtividade);
                            array_push($arrayAtividadesEquipe, [
                                'idAtividade'               => $macroAtividade->idAtividade,
                                'idEquipe'                  => $macroAtividade->idEquipe,
                                'nomeAtividade'             => $macroAtividade->nomeAtividade,
                                'sinteseAtividade'          => $macroAtividade->sinteseAtividade,
                                'iconeAtividade'            => $macroAtividade->iconeAtividade,
                                'microAtividade'            => $arrayMicroAtividades,
                            ]);
                        } else {
                            array_push($arrayAtividadesEquipe, [
                                'idAtividade'               => $macroAtividade->idAtividade,
                                'nomeAtividade'             => $macroAtividade->nomeAtividade,
                                'sinteseAtividade'          => $macroAtividade->sinteseAtividade,
                                'iconeAtividade'            => $macroAtividade->iconeAtividade,
                            ]);
                        }
                    }
                }
                $arrayDadosEquipe = [
                    'idEquipe'      => $equipe->idEquipe,
                    'nomeEquipe'    => $equipe->nomeEquipe,
                    'iconeEquipe'   => $equipe->iconeEquipe,
                    'atividades'    => $arrayAtividadesEquipe
                ];
                array_push($arrayEquipesComAtividadesAtende, $arrayDadosEquipe);
            }
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
        }
        return json_encode($arrayEquipesComAtividadesAtende);
    }

    public static function listaMicroAtividades($idAtividadeSubordinante) {
        $arrayAtividadesSubordinadas = [];
        $listaAtividadesSubordinadas = GestaoEquipesAtividades::where('idAtividadeSubordinante', $idAtividadeSubordinante)->where('atividadeAtiva', true)->where('incluirAtividadeAtende', true)->get();
        foreach ($listaAtividadesSubordinadas as $atividadeSubordinada) {
            array_push($arrayAtividadesSubordinadas, [
                'idAtividade'               => $atividadeSubordinada->idAtividade,
                'idAtividadeSubordinante'   => $atividadeSubordinada->idAtividadeSubordinante,
                'idEquipe'                  => $atividadeSubordinada->GestaoEquipesCelulas->idEquipe,
                'nomeAtividade'             => $atividadeSubordinada->nomeAtividade,
                'sinteseAtividade'          => $atividadeSubordinada->sinteseAtividade,
                'iconeAtividade'            => $atividadeSubordinada->iconeAtividade,
            ]);
        }
        return $arrayAtividadesSubordinadas;
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function contagemAtendesDisponiveisResponsavel()
    {
        $contagemDemandasAtende = Atende::where('matriculaResponsavelAtividade', session('matricula'))->where('statusAtende', '!=', 'FINALIZADO')->count();
        
        return json_encode($contagemDemandasAtende);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarNovaDemandaAtende(Request $request)
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $dadosSimov = BaseSimov::where('BEM_FORMATADO', $request->contratoFormatado)->first();
            $dadosAtividade = GestaoEquipesAtividades::find($request->idAtividade);

            // CRIAR A DEMANDA
            $novaDemandaAtende = new Atende;
            $novaDemandaAtende->contratoFormatado               = $request->contratoFormatado;
            $novaDemandaAtende->codigoUnidade                   = $dadosAtividade->GestaoEquipesCelulas->codigoUnidadeEquipe;
            $novaDemandaAtende->idEquipe                        = $request->idEquipe;
            $novaDemandaAtende->idAtividade                     = $request->idAtividade;
            $novaDemandaAtende->numeroContrato                  = $dadosSimov->NU_BEM;
            $novaDemandaAtende->assuntoAtende                   = $request->assuntoAtende;
            $novaDemandaAtende->descricaoAtende                 = $request->descricaoAtende;
            $novaDemandaAtende->statusAtende                    = 'CADASTRADO';
            $novaDemandaAtende->matriculaCriadorDemanda         = session('matricula');
            $novaDemandaAtende->prazoAtendimentoAtende          = DiasUteisClass::contadorDiasUteis(date("Y-m-d", time()), $dadosAtividade->prazoAtendimento);
            $novaDemandaAtende->matriculaResponsavelAtividade   = self::defineResponsavelDemandaAtende($request->idAtividade, $dadosAtividade);
            $novaDemandaAtende->dataCadastro                    = date("Y-m-d H:i:s", time());
            $novaDemandaAtende->dataAlteracao                   = date("Y-m-d H:i:s", time());
            if ($request->has('emailContatoResposta')) {
                $novaDemandaAtende->emailContatoResposta        = $request->emailContatoResposta;
            }

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $novaDemandaAtende->save();

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $request->contratoFormatado;
            $historico->tipo            = "CADASTRO";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "CADASTRO DO ATENDE #" . str_pad($novaDemandaAtende->idAtende, 4, '0', STR_PAD_LEFT) . " - ATIVIDADE: " . $dadosAtividade->nomeAtividade;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Cadastro realizado!");
            $request->session()->flash('corpoMensagem', "O cadastro do Atende foi realizado com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Edição não efetuada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a edição dos dados cadastrais do contrato. Tente novamente");
        }
        return redirect("/consulta-bem-imovel/" . $request->contratoFormatado);
    }

    public static function defineResponsavelDemandaAtende($idAtividade, $dadosAtividade) 
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $dadosEquipe = GestaoEquipesCelulas::find($dadosAtividade->idEquipe); 

            // CAPTURA A LISTA DE EMPREGADOS QUE REALIZAM AQUELA ATIVIDADE
            $listaResponsaveisAtividade = GestaoEquipesAtividadesResponsaveis::where('idAtividade', $idAtividade)->where('atuandoAtividade', true)->get();

            // CRIO DUAS VARIÁVEIS DE CONTROLE, UMA DE PRODUÇÃO E OUTRA PARA ATRIBUIR O RESPONSAVEL DA DEMANDA
            $responsavelDemandaAtende = '';
            $quantidadeDemandasControle = 10000;

            /* 
                VALIDO SE EXISTEM RESPONSAVEIS ATIVOS QUE REALIZAM A ATIVIDADE
                CASO POSITIVO FAÇO O LEVANTAMENTO DA QUANTIDADE DE DEMANDAS QUE CADA RESPONSAVEL TEM E ATRIBUO PARA AQUELE COM MENOR NÚMERO DE ATENDES
                CASO NEGATIVO, NÃO EXISTEM RESPONSAVEIS NA ATIVIDADE E A DEMANDA SERÁ ATRIBUIDA PARA O GESTOR RESPONSAVEL DA EQUIPE
            */
            if (!$listaResponsaveisAtividade->isEmpty()) {
                foreach ($listaResponsaveisAtividade as $responsavel) {
                    $quantidadeDemandasAtribuidas = Atende::where('matriculaResponsavelAtividade', $responsavel->matriculaResponsavelAtividade)->where('statusAtende' , "!=", 'FINALIZADO')->count() !== null ? Atende::where('matriculaResponsavelAtividade', $responsavel->matriculaResponsavelAtividade)->count() : null;
                    if (!is_null($quantidadeDemandasAtribuidas)) {
                        if ($quantidadeDemandasAtribuidas < $quantidadeDemandasControle) {
                            $responsavelDemandaAtende = $responsavel->matriculaResponsavelAtividade;
                        }
                    }
                }
            }
            if ($responsavelDemandaAtende == '') {
                $responsavelDemandaAtende = $dadosEquipe->matriculaGestor;
            }
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
        }
        return $responsavelDemandaAtende;
    }

    /**
     *
     * @param  int  $idAtende
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function responderAtende(Request $request, $idAtende)
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $responderAtende = Atende::find($idAtende);

            // EDITAR DADOS DEMANDA
            $responderAtende->statusAtende      = 'FINALIZADO';
            $responderAtende->respostaAtende    = $request->respostaAtende;
            $responderAtende->dataAlteracao     = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $responderAtende->contratoFormatado;
            $historico->tipo            = "RESPOSTA";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "ATENDE #" . str_pad($novaDemandaAtende->idAtende, 4, '0', STR_PAD_LEFT) . $request->respostaAtende;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $responderAtende->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Atende respondido!");
            $request->session()->flash('corpoMensagem', "O Atende foi respondido com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Resposta não registrada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante registro da resposta do Atende. Tente novamente");
        }
        return redirect("/atende/minhas-demandas");
    }

    /**
     *
     * @param  int  $idAtende
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function redirecionarAtende(Request $request, $idAtende)
    {
        try {
            DB::beginTransaction();
            // CAPTURAR DADOS DOS DEMAIS MODELS (CASO NECESSÁRIO)
            $redirecionarAtende = Atende::find($idAtende);

            // EDITAR DADOS DEMANDA
            $redirecionarAtende->statusAtende                   = 'REDIRECIONADO';
            $redirecionarAtende->motivoRedirecionamento         = $request->motivoRedirecionamento;
            $redirecionarAtende->matriculaResponsavelAtividade  = $request->matriculaResponsavelAtividade;
            $redirecionarAtende->dataAlteracao                  = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $redirecionarAtende->contratoFormatado;
            $historico->tipo            = "REDIRECIONADO";
            $historico->atividade       = "ATENDE";
            $historico->observacao      = "ATENDE #" . str_pad($novaDemandaAtende->idAtende, 4, '0', STR_PAD_LEFT) . $request->motivoRedirecionamento;
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $redirecionarAtende->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Atende respondido!");
            $request->session()->flash('corpoMensagem', "O Atende foi respondido com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Resposta não registrada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante registro da resposta do Atende. Tente novamente");
        }
        return redirect("/atende/minhas-demandas");
    }

    public function controlaPrazoAtende()
    {
        try {
            DB::beginTransaction();
            $arrayEquipesComAtividadesAtende = [];
            $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
            $demandasVencidas = 0;
            $demandasVencemHoje = 0;
            $demandasVencemProximoDiaUtil = 0;
            $demandasVencemDoisDiasUteis = 0;
            $demandasVencimentoLongo = 0;

            // CAPTURAR AS QUANTIDADE DE DEMANDAS ATENDE DAQUELA UNIDADE
            $listaEquipesUnidade = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->get();
            foreach ($listaEquipesUnidade as $atende) {
                $diasParaVencerPrazo = Carbon::diffInBusinessDays(Carbon::parse($atende->prazoAtendimentoAtende));
                if ($diasParaVencerPrazo < 0) {
                    $demandasVencidas++;
                } else {
                    switch ($diasParaVencerPrazo) {
                        case 0:
                            $demandasVencemHoje++;
                            break;
                        case 1:
                            $demandasVencemProximoDiaUtil++;
                            break;
                        case 2:
                            $demandasVencemDoisDiasUteis++;
                            break;
                        default:
                            $demandasVencimentoLongo++;
                            break;
                    }
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
        }
        return json_encode([
            'demandasVencidas'              => $demandasVencidas,
            'demandasVencemHoje'            => $demandasVencemHoje,
            'demandasVencemProximoDiaUtil'  => $demandasVencemProximoDiaUtil,
            'demandasVencemDoisDiasUteis'   => $demandasVencemDoisDiasUteis,
            'demandasVencimentoLongo'       => $demandasVencimentoLongo,
        ]);
    }

    public function listarDemandasUnidadePorPrazo($prazo)
    {
        try {
            DB::beginTransaction();
            $unidadeUsuario = Ldap::defineUnidadeUsuarioSessao();
            $arrayDadosDemandas = [];
            $listaDemandas =[];
            // VERIFICAR QUAL É A DATA DE VENCIMENTO ESCOLHIDA PELO GESTOR
            switch ($prazo) {
                case 'demandasVencidas':
                    $listaDemandas = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->where('prazoAtendimentoAtende', '<', Carbon::now())->get();
                    break;
                case 'demandasVencemHoje':
                    $listaDemandas = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->where('prazoAtendimentoAtende', Carbon::now())->get();
                    break;
                case 'demandasVencemProximoDiaUtil':
                    $listaDemandas = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->where('prazoAtendimentoAtende', Carbon::parse(Carbon::now())->addBusinessDays(1)->format('Y-m-d'))->get();
                    break;
                case 'demandasVencemProximoDiaUtil':
                    $listaDemandas = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->where('prazoAtendimentoAtende', Carbon::parse(Carbon::now())->addBusinessDays(2)->format('Y-m-d'))->get();
                    break;
                case 'demandasVencemProximoDiaUtil':
                    $listaDemandas = Atende::where('codigoUnidade', $unidadeUsuario)->where('statusAtende', '!=', 'FINALIZADO')->where('prazoAtendimentoAtende', '>=', Carbon::parse(Carbon::now())->addBusinessDays(3)->format('Y-m-d'))->get();
                    break;
            }
            foreach ($listaDemandas as $demanda) {
                array_push($arrayDadosDemandas, [
                    'idAtende'                      => $demanda->idAtende,
                    'idEquipe'                      => $demanda->idEquipe,
                    'nomeEquipe'                    => $demanda->gestaoEquipeCelulas->nomeEquipe,
                    'nomeGestor'                    => $demanda->gestaoEquipeCelulas->nomeGestor,
                    'idAtividade'                   => $demanda->idAtividade,
                    'nomeAtividade'                 => $demanda->gestaoEquipesAtividades->nomeAtividade,
                    'contratoFormatado'             => $demanda->contratoFormatado,
                    'numeroContrato'                => $demanda->numeroContrato,
                    'assuntoAtende'                 => $demanda->assuntoAtende,
                    'descricaoAtende'               => $demanda->descricaoAtende,
                    'matriculaResponsavelAtividade' => $demanda->matriculaResponsavelAtividade,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
        }
        return json_encode($arrayDadosDemandas);
    }
}
