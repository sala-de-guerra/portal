<?php

namespace App\Http\Controllers\LeilaoNegativo;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use App\Models\Fornecedores\Despachante;
use App\Models\Fornecedores\Leiloeiro;
use App\Models\LeilaoNegativo\LeilaoNegativo;
use App\Models\HistoricoPortalGilie;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LeilaoNegativoController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.imoveis.leiloes.leiloes-negativos');
    }

    /**
     *
     * @param  string  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function viewTratarLeilaoNegativo($contratoFormatado)
    {
        return view('portal.imoveis.leiloes.operacional-leiloes')->with('contratoFormatado', $contratoFormatado);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarContratosControleLeiloesNegativos(Request $request)
    {
        try {
            DB::beginTransaction();
            $quantidadeRegistrosTabelaLeiloesNegativosContratosAntes = LeilaoNegativo::count();
            $mensagem = "<p>Quantidade de registro na tabela antes da rotina: $quantidadeRegistrosTabelaLeiloesNegativosContratosAntes</p>";
            $universoContratosParaCadastro = BaseSimov::where(function($classificacaoImovel) {
                                                            $classificacaoImovel->where('CLASSIFICACAO', '=', 'SFI - Gar.Fid.Reg.Créd.Imob')
                                                                                ->orWhere('CLASSIFICACAO', '=', 'Patrimonial - Alienação Fiduciária')
                                                                                ->orWhere('CLASSIFICACAO', '=', 'EMGEA- Alienação Fiduciária');
                                                        })->whereNull('DT_PROPRIEDADE_PLENA')
                                                        ->select('BEM_FORMATADO', 'NU_BEM', 'UNA', 'CLASSIFICACAO', 'CIDADE', 'OFICIO', 'MATRICULA', 'ENDERECO_IMOVEL', 'AGRUPAMENTO', 'STATUS_IMOVEL', 'DT_PRIMEIRO_LEILAO', 'DT_SEGUNDO_LEILAO')
                                                        ->get();
            foreach ($universoContratosParaCadastro as $contrato) {
                /*
                    REGRA DE NEGOCIO PARA DETERMINAR AS DATAS DE PREVISÃO DE RECEBIMENTO DO DOCUMENTOS DO LEILOEIRO E PREVISÃO DE ENTREGA DOCUMENTOS AO DESPACHANTE

                    PREVISÃO DE RECEBIMENTO DO DOCUMENTOS DO LEILOEIRO  = 5 DIAS ÚTEIS A PARTIR DA DATA DO SEGUNDO LEILÃO
                    PREVISÃO DE ENTREGA DOCUMENTOS AO DESPACHANTE       = 3 DIAS ÚTEIS A PARTIR DA ENTREGA DOS DOCUMENTOS PELO LEILOEIRO
                */
                $dataPrevisaoRecebimentoDocumentosLeiloeiro = self::contadorDiasUteis($contrato->DT_SEGUNDO_LEILAO, 5);
                $dataPrevisaoDisponibilizacaoDocumentosAoDespachante = self::contadorDiasUteis($dataPrevisaoRecebimentoDocumentosLeiloeiro, 3);
                $unidadeResponsavel = Ldap::defineCodigoUnidadeUsuarioSessao($contrato->UNA);

                // VALIDA SE JÁ EXISTE ESSE CONTRATO NO CONTROLE, CASO NEGATIVO ELE FAZ O INSERT
                $cadastroContratoLeilaoNegativo = LeilaoNegativo::firstOrCreate(
                    ['contratoFormatado' => $contrato->BEM_FORMATADO],
                    [
                        'contratoFormatado'                                 => $contrato->BEM_FORMATADO,
                        'numeroContrato'                                    => $contrato->NU_BEM,
                        'numeroLeilao'                                      => $contrato->AGRUPAMENTO,
                        'previsaoRecebimentoDocumentosLeiloeiro'            => $dataPrevisaoRecebimentoDocumentosLeiloeiro,
                        'previsaoDisponibilizacaoDocumentosAoDespachante'   => $dataPrevisaoDisponibilizacaoDocumentosAoDespachante,
                        'statusAverbacao'                                   => 'CADASTRADO',
                        'unidadeResponsavel'                                => $unidadeResponsavel,
                        'dataCadastro'                                      => date("Y-m-d H:i:s", time()),
                        'dataAlteracao'                                     => date("Y-m-d H:i:s", time()),
                    ]
                );
            }
            $quantidadeRegistrosTabelaLeiloesNegativosContratosDepois = LeilaoNegativo::count();
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
        }
        $mensagem .= "<p>Quantidade de registro na tabela depois da rotina: $quantidadeRegistrosTabelaLeiloesNegativosContratosDepois</p>";
        $quantidadeNovosContratos = $quantidadeRegistrosTabelaLeiloesNegativosContratosDepois - $quantidadeRegistrosTabelaLeiloesNegativosContratosAntes;
        $mensagem .= "<p>Quantidade de novos registros na tabela: $quantidadeNovosContratos</p>";
        return $mensagem;    
    }

    public static function contadorDiasUteis($data, $quantidadeDiasUteis) 
    {
        $dataProposta = Carbon::parse($data);
        $diasUteis = 0;

        $feriados = array(
            'dia-mundial-da-paz' => '01-01',
            'terca-carnaval' => '= easter -47',
            'segunda-carnaval' => '= easter -48',
            'sexta-feira-da-paixao' => '= easter -2',
            'tirandentes' => '04-21',
            'trabalho' => '05-01',
            'corpus-christi' => '= easter 60',
            'independencia-do-brasil' => '09-07',
            'nossa-sra-aparecida' => '10-12',
            'finados' => '11-02',
            'proclamacao-republica' => '11-15',
            'natal' => '12-25',
            'ultimo-dia-util' => '12-31',
        );
        
        BusinessDay::enable('Illuminate\Support\Carbon', 'br-national', $feriados);
        Carbon::setHolidaysRegion('br-national');
        while ($diasUteis < $quantidadeDiasUteis) {
            $dataProposta->addDay();
            if (!$dataProposta->isBusinessDay()) {
                $dataProposta = $dataProposta->nextBusinessDay();
            }
            $diasUteis++;
        }
        return $dataProposta->format('Y-m-d');
    }

    /**
     *
     * @param  int  $codigoUnidade
     * @return \Illuminate\Http\Response
     */
    public function listarContratosLeilaoNegativo($codigoUnidade)
    {
        $contratosLeilaoNegativo = LeilaoNegativo::where('unidadeResponsavel', $codigoUnidade)->select('contratoFormatado', 'numeroContrato', 'numeroLeilao', 'statusAverbacao', 'dataAlteracao')->get(); //

        return json_encode($contratosLeilaoNegativo);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function editarDadosCadastraisContratoLeilaoNegativo(Request $request, $contratoFormatado)
    {
        try {
            DB::beginTransaction();
            // CAPTURA OS DADOS DA DEMANDA
            $atualizarContratoLeilaoNegativo = LeilaoNegativo::where('contratoFormatado', $contratoFormatado)->first();
            $atualizarContratoLeilaoNegativo->numeroLeilao                                      = !in_array($request->numeroLeilao, [null, 'NULL', '']) ? $request->numeroLeilao : $atualizarContratoLeilaoNegativo->numeroLeilao;
            $atualizarContratoLeilaoNegativo->previsaoRecebimentoDocumentosLeiloeiro            = !in_array($request->previsaoRecebimentoDocumentosLeiloeiro, [null, 'NULL', '']) ? $request->previsaoRecebimentoDocumentosLeiloeiro : $atualizarContratoLeilaoNegativo->previsaoRecebimentoDocumentosLeiloeiro;    
            $atualizarContratoLeilaoNegativo->previsaoDisponibilizacaoDocumentosAoDespachante   = !in_array($request->previsaoDisponibilizacaoDocumentosAoDespachante, [null, 'NULL', '']) ? $request->previsaoDisponibilizacaoDocumentosAoDespachante : $atualizarContratoLeilaoNegativo->previsaoDisponibilizacaoDocumentosAoDespachante;
            $atualizarContratoLeilaoNegativo->dataAlteracao                                     = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $atualizarContratoLeilaoNegativo->contratoFormatado;
            $historico->tipo            = "REGISTRO";
            $historico->atividade       = "LEILÃO NEGATIVO";
            $historico->observacao      = "EDIÇÃO DADOS CADASTRAIS CONTRATO";
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // SALVA O ID LEILOEIRO EM TODOS OS CONTRATOS DO MESMO LEILÃO
            self::registraLeiloeiroNosContratosLeilao($atualizarContratoLeilaoNegativo->numeroLeilao, $request->idLeiloeiro);

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $atualizarContratoLeilaoNegativo->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Edição realizada!");
            $request->session()->flash('corpoMensagem', "A edição dos dados cadastrais do contrato foi realizado com sucesso.");

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
        return redirect("/estoque-imoveis/leiloes-negativos/tratar/" . $contratoFormatado);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function receberDocumentosLeiloeiro(Request $request, $contratoFormatado)
    {
        try {
            DB::beginTransaction();
            // CAPTURA OS DADOS DA DEMANDA
            $atualizarContratoLeilaoNegativo = LeilaoNegativo::where('contratoFormatado', $contratoFormatado)->first();
            $atualizarContratoLeilaoNegativo->idLeiloeiro                       = $request->idLeiloeiro;
            $atualizarContratoLeilaoNegativo->dataEntregaDocumentosLeiloeiro    = $request->dataEntregaDocumentosLeiloeiro;
            $atualizarContratoLeilaoNegativo->dataAlteracao                     = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $atualizarContratoLeilaoNegativo->contratoFormatado;
            $historico->tipo            = "REGISTRO";
            $historico->atividade       = "LEILÃO NEGATIVO";
            $historico->observacao      = "DOCUMENTOS ENTREGUE PELO LEILOEIRO";
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // SALVA O ID LEILOEIRO EM TODOS OS CONTRATOS DO MESMO LEILÃO
            self::registraLeiloeiroNosContratosLeilao($atualizarContratoLeilaoNegativo->numeroLeilao, $request->idLeiloeiro);

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $atualizarContratoLeilaoNegativo->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Registro realizado!");
            $request->session()->flash('corpoMensagem', "O registro referente ao recebimento do kit do leiloeiro foi cadastrado com sucesso.");

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
            $request->session()->flash('tituloMensagem', "Registro não efetuado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro do recebimento do kit do leiloeiro. Tente novamente");
        }
        return redirect("/estoque-imoveis/leiloes-negativos/tratar/" . $contratoFormatado);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function entregarDocumentosDespachante(Request $request, $contratoFormatado)
    {
        try {
            DB::beginTransaction();
            /*
                REGRA DE NEGOCIO PARA DETERMINAR AS DATA ENTREGA DOCUMENTOS CARTÓRIO

                DATA ENTREGA DOCUMENTOS CARTÓRIO  = 5 DIAS ÚTEIS A PARTIR DA DATA DE ENTREGA DOS DOCUMENTOS AO DESPACHANTE
            */
            $dataPrevisaoEntregaDocumentosCartorio = self::contadorDiasUteis($request->dataRetiradaDocumentosDespachante, 5);

            // CAPTURA OS DADOS DA DEMANDA
            $atualizarContratoLeilaoNegativo = LeilaoNegativo::where('contratoFormatado', $contratoFormatado)->first();
            $atualizarContratoLeilaoNegativo->idDespachante                     = $request->idDespachante;
            $atualizarContratoLeilaoNegativo->dataRetiradaDocumentosDespachante = $request->dataRetiradaDocumentosDespachante;
            $atualizarContratoLeilaoNegativo->numeroOficioUnidade               = $request->$numeroOficioUnidade;
            $atualizarContratoLeilaoNegativo->previsaoEntregaDocumentosCartorio = $dataPrevisaoEntregaDocumentosCartorio;
            $atualizarContratoLeilaoNegativo->dataAlteracao                     = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $atualizarContratoLeilaoNegativo->contratoFormatado;
            $historico->tipo            = "REGISTRO";
            $historico->atividade       = "LEILÃO NEGATIVO";
            $historico->observacao      = "DOCUMENTOS ENTREGUE PARA DESPACHANTE";
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // SALVA O ID DESPACHANTE EM TODOS OS CONTRATOS DO MESMO LEILÃO
            self::registraDespachanteNosContratosLeilao($atualizarContratoLeilaoNegativo->numeroLeilao, $request->idDespachante);

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $atualizarContratoLeilaoNegativo->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Registro realizado!");
            $request->session()->flash('corpoMensagem', "O registro referente a entrega dos documentos ao despachante foi cadastrado com sucesso.");

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
            $request->session()->flash('tituloMensagem', "Registro não efetuado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro da entrega dos documetos ao despachante. Tente novamente");
        }
        return redirect("/estoque-imoveis/leiloes-negativos/tratar/" . $contratoFormatado);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function receberDocumentosDespachante(Request $request, $contratoFormatado)
    {
        try {
            DB::beginTransaction();

            // CAPTURA OS DADOS DA DEMANDA
            $atualizarContratoLeilaoNegativo = LeilaoNegativo::where('contratoFormatado', $contratoFormatado)->first();
            $atualizarContratoLeilaoNegativo->numeroProtocoloCartorio               = $request->numeroProtocoloCartorio;
            $atualizarContratoLeilaoNegativo->codigoAcessoProtocoloCartorio         = $request->codigoAcessoProtocoloCartorio;
            $atualizarContratoLeilaoNegativo->dataPrevistaAnaliseCartorio           = $request->dataPrevistaAnaliseCartorio;
            $atualizarContratoLeilaoNegativo->dataRetiradaDocumentoCartorio         = $request->dataRetiradaDocumentoCartorio;
            $atualizarContratoLeilaoNegativo->dataEntregaAverbacaoExigenciaUnidade  = $request->dataEntregaAverbacaoExigenciaUnidade;
            $atualizarContratoLeilaoNegativo->existeExigencia                       = $request->existeExigencia;
            $atualizarContratoLeilaoNegativo->dataAlteracao                         = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $contratoFormatado;
            $historico->tipo            = "REGISTRO";
            $historico->atividade       = "LEILÃO NEGATIVO";
            $historico->observacao      = !in_array($request->numeroContrato, [null, 'NULL', '']) ? strtoupper(strip_tags($request->observacao)) : "DOCUMENTOS RECEBIDOS PELO DESPACHANTE"; 
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $atualizarContratoLeilaoNegativo->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Registro realizado!");
            $request->session()->flash('corpoMensagem', "O registro referente a entrega dos documentos ao despachante foi cadastrado com sucesso.");

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
            $request->session()->flash('tituloMensagem', "Registro não efetuado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro da entrega dos documetos ao despachante. Tente novamente");
        }
        return redirect("/estoque-imoveis/leiloes-negativos/tratar/" . $contratoFormatado);
    }

    public static function registraLeiloeiroNosContratosLeilao($numeroLeilao, $idLeiloeiro) 
    {
        try {
            DB::beginTransaction();
            $contratosLeilao = LeilaoNegativo::where('numeroLeilao', $numeroLeilao)->get();
            foreach ($contratosLeilao as $contrato) {
                $contrato->idLeiloeiro = $idLeiloeiro;
                $contrato->save();
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
    }

    public static function registraDespachanteNosContratosLeilao($numeroLeilao, $idDespachante) 
    {
        try {
            DB::beginTransaction();
            $contratosLeilao = LeilaoNegativo::where('numeroLeilao', $numeroLeilao)->get();
            foreach ($contratosLeilao as $contrato) {
                $contrato->idDespachante = $idDespachante;
                $contrato->save();
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
    }
}