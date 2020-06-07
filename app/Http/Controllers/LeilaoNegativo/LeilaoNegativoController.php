<?php

namespace App\Http\Controllers\LeilaoNegativo;

use App\Classes\DiasUteisClass;
use App\Classes\Ldap;
use App\TabelaImportExcel;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use App\Models\Fornecedores\Despachante;
use App\Models\Fornecedores\Leiloeiro;
use App\Models\LeilaoNegativo\LeilaoNegativo;
use App\Models\LeilaoNegativo\Codigo_correio_leilaoNegativo;
use App\Models\HistoricoPortalGilie;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\CriaExcelLeilaoNegativo;
use DOMDocument;
use Maatwebsite\Excel\Facades\Excel;

class LeilaoNegativoController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function viewListaLeiloesUnidade()
    {
        return view('portal.imoveis.leiloes.leiloes-negativos');
    }
    
    /**
     *
     * @param  string  $dataSegundoLeilao
     * @return \Illuminate\Http\Response
     */
    public function viewListaContratosSegundoLeilao($dataSegundoLeilao)
    {
        return view('portal.imoveis.leiloes.contratos-leilao')->with('dataSegundoLeilao', $dataSegundoLeilao);
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
                                                        })->whereNotNull('DT_SEGUNDO_LEILAO')->where('DT_SEGUNDO_LEILAO', '>=', '2018-01-01')
                                                        ->select('BEM_FORMATADO', 'NU_BEM', 'UNA', 'CIDADE', 'AGRUPAMENTO', 'DT_SEGUNDO_LEILAO') //, 'CLASSIFICACAO', 'OFICIO', 'MATRICULA', 'ENDERECO_IMOVEL', 'STATUS_IMOVEL', 'DT_PRIMEIRO_LEILAO'
                                                        ->get();
            foreach ($universoContratosParaCadastro as $contrato) {
                /*
                    REGRA DE NEGOCIO PARA DETERMINAR AS DATAS DE PREVISÃO DE RECEBIMENTO DO DOCUMENTOS DO LEILOEIRO E PREVISÃO DE ENTREGA DOCUMENTOS AO DESPACHANTE

                    PREVISÃO DE RECEBIMENTO DO DOCUMENTOS DO LEILOEIRO  = 5 DIAS ÚTEIS A PARTIR DA DATA DO SEGUNDO LEILÃO
                    PREVISÃO DE ENTREGA DOCUMENTOS AO DESPACHANTE       = 3 DIAS ÚTEIS A PARTIR DA ENTREGA DOS DOCUMENTOS PELO LEILOEIRO
                */
                $dataPrevisaoRecebimentoDocumentosLeiloeiro = DiasUteisClass::contadorDiasUteis($contrato->DT_SEGUNDO_LEILAO, 5);
                $dataPrevisaoDisponibilizacaoDocumentosAoDespachante = DiasUteisClass::contadorDiasUteis($dataPrevisaoRecebimentoDocumentosLeiloeiro, 3);
                $unidadeResponsavel = Ldap::defineCodigoUnidadeUsuarioSessao($contrato->UNA);
                // VALIDA SE JÁ EXISTE ESSE CONTRATO NO CONTROLE, CASO NEGATIVO ELE FAZ O INSERT
                $cadastroContratoLeilaoNegativo = LeilaoNegativo::firstOrCreate(
                    ['contratoFormatado' => $contrato->BEM_FORMATADO, 'contratoAtivo' => true],
                    [
                        'contratoFormatado'                                 => $contrato->BEM_FORMATADO,
                        'numeroContrato'                                    => $contrato->NU_BEM,
                        'dataSegundoLeilao'                                 => $contrato->DT_SEGUNDO_LEILAO,
                        'statusAverbacao'                                   => 'AGUARDA DOC LEILOEIRO',
                        'unidadeResponsavel'                                => $unidadeResponsavel,
                        'cidadeComarcaCartorio'                             => $contrato->CIDADE,
                        'previsaoRecebimentoDocumentosLeiloeiro'            => $dataPrevisaoRecebimentoDocumentosLeiloeiro,
                        'previsaoDisponibilizacaoDocumentosAoDespachante'   => $dataPrevisaoDisponibilizacaoDocumentosAoDespachante,
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

    // public static function contadorDiasUteis($data, $quantidadeDiasUteis) 
    // {
    //     $dataProposta = Carbon::parse($data);
    //     $diasUteis = 0;

    //     $feriados = array(
    //         'dia-mundial-da-paz' => '01-01',
    //         'terca-carnaval' => '= easter -47',
    //         'segunda-carnaval' => '= easter -48',
    //         'sexta-feira-da-paixao' => '= easter -2',
    //         'tirandentes' => '04-21',
    //         'trabalho' => '05-01',
    //         'corpus-christi' => '= easter 60',
    //         'independencia-do-brasil' => '09-07',
    //         'nossa-sra-aparecida' => '10-12',
    //         'finados' => '11-02',
    //         'proclamacao-republica' => '11-15',
    //         'natal' => '12-25',
    //         'ultimo-dia-util' => '12-31',
    //     );
        
    //     BusinessDay::enable('Illuminate\Support\Carbon', 'br-national', $feriados);
    //     Carbon::setHolidaysRegion('br-national');
    //     while ($diasUteis < $quantidadeDiasUteis) {
    //         $dataProposta->addDay();
    //         if (!$dataProposta->isBusinessDay()) {
    //             $dataProposta = $dataProposta->nextBusinessDay();
    //         }
    //         $diasUteis++;
    //     }
    //     return $dataProposta->format('Y-m-d');
    // }

    /**
     *
     * @param  int  $codigoUnidade
     * @return \Illuminate\Http\Response
     */
    public function listarLeiloesUnidade($codigoUnidade)
    {
        $listaLeiloesUnidade = LeilaoNegativo::where('unidadeResponsavel', $codigoUnidade)
                                                ->select('dataSegundoLeilao', 'numeroLeilao', DB::raw('COUNT(numeroContrato) AS numeroContrato'))
                                                ->where('statusAverbacao', '!=', 'AVERBACAO CONCLUIDA')
                                                ->where('contratoAtivo', true)
                                                ->groupBy('dataSegundoLeilao', 'numeroLeilao')
                                                ->get();
        return json_encode($listaLeiloesUnidade);
    }

    /**
     *
     * @param  string  $dataSegundoLeilao
     * @return \Illuminate\Http\Response
     */
    public function listarContratosLeilao($dataSegundoLeilao)
    {
        $unidade = Ldap::defineUnidadeUsuarioSessao();
        $listaContratosSegundoLeilao = LeilaoNegativo::select('contratoFormatado', 'numeroContrato', 'numeroLeilao', 'statusAverbacao', 'dataAlteracao')
                                                        ->where('unidadeResponsavel', $unidade)
                                                        ->where('dataSegundoLeilao', $dataSegundoLeilao)
                                                        ->where('contratoAtivo', true)
                                                        ->where('statusAverbacao', '!=', 'AVERBACAO CONCLUIDA')
                                                        ->get();
        return json_encode($listaContratosSegundoLeilao);
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
            // AJUSTAR A DATA QUE ESTÁ VINDO DO FRONT
            $dataPrevisaoRecebimentoDocumentosLeiloeiro = Carbon::createFromFormat('d/m/Y', $request->previsaoRecebimentoDocumentosLeiloeiro);
            $dataPrevisaoDisponibilizacaoDocumentosAoDespachante = Carbon::createFromFormat('d/m/Y', $request->previsaoDisponibilizacaoDocumentosAoDespachante);

            // CAPTURA OS DADOS DA DEMANDA
            $atualizarContratoLeilaoNegativo = LeilaoNegativo::where('contratoFormatado', $contratoFormatado)->first();
            $atualizarContratoLeilaoNegativo->numeroLeilao                                      = !in_array($request->numeroLeilao, [null, 'NULL', '']) ? $request->numeroLeilao : $atualizarContratoLeilaoNegativo->numeroLeilao;
            $atualizarContratoLeilaoNegativo->previsaoRecebimentoDocumentosLeiloeiro            = !in_array($request->previsaoRecebimentoDocumentosLeiloeiro, [null, 'NULL', '']) ? $dataPrevisaoRecebimentoDocumentosLeiloeiro->format('Y-m-d') : $atualizarContratoLeilaoNegativo->previsaoRecebimentoDocumentosLeiloeiro;    
            $atualizarContratoLeilaoNegativo->previsaoDisponibilizacaoDocumentosAoDespachante   = !in_array($request->previsaoDisponibilizacaoDocumentosAoDespachante, [null, 'NULL', '']) ? $dataPrevisaoDisponibilizacaoDocumentosAoDespachante->format('Y-m-d') : $atualizarContratoLeilaoNegativo->previsaoDisponibilizacaoDocumentosAoDespachante;
            $atualizarContratoLeilaoNegativo->cidadeComarcaCartorio                             = !in_array($request->cidadeComarcaCartorio, [null, 'NULL', '']) ? mb_convert_case($request->cidadeComarcaCartorio, MB_CASE_UPPER, 'UTF-8') : $atualizarContratoLeilaoNegativo->cidadeComarcaCartorio;
            $atualizarContratoLeilaoNegativo->codigoCorreio                                     = !in_array($request->codigoCorreio, [null, 'NULL', '']) ? mb_convert_case($request->codigoCorreio, MB_CASE_UPPER, 'UTF-8') : $atualizarContratoLeilaoNegativo->codigoCorreio;
            $atualizarContratoLeilaoNegativo->dataAlteracao                                     = date("Y-m-d H:i:s", time());

            // SENSIBILIZA TODOS OS CONTRATOS DO LEILAO
            if ($request->sensibilizarTodosContratosLeilao == 'SIM') {
                self::editarDadosCadastraisTodosContratosLeilao($atualizarContratoLeilaoNegativo, $request);
            }

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
            // AJUSTAR A DATA QUE ESTÁ VINDO DO FRONT
            $dataEntregaDocumentosLeiloeiroFormatada = Carbon::createFromFormat('d/m/Y', $request->dataEntregaDocumentosLeiloeiro);

            // CAPTURA OS DADOS DA DEMANDA
            $atualizarContratoLeilaoNegativo = LeilaoNegativo::where('contratoFormatado', $contratoFormatado)->where('contratoAtivo', true)->first();
            $atualizarContratoLeilaoNegativo->idLeiloeiro                       = $request->idLeiloeiro;
            $atualizarContratoLeilaoNegativo->dataEntregaDocumentosLeiloeiro    = $dataEntregaDocumentosLeiloeiroFormatada;
            $atualizarContratoLeilaoNegativo->statusAverbacao                   = 'RECEBIDO DOC LEILOEIRO';
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
            self::registraLeiloeiroNosContratosLeilao($atualizarContratoLeilaoNegativo->dataSegundoLeilao, $atualizarContratoLeilaoNegativo->unidadeResponsavel, $request);

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
        // dd($request);
        try {
            DB::beginTransaction();
            // AJUSTAR A DATA QUE ESTÁ VINDO DO FRONT
            $dataRetiradaDocumentosDespachanteFormatada = Carbon::createFromFormat('d/m/Y', $request->dataRetiradaDocumentosDespachante);
            /*
                REGRA DE NEGOCIO PARA DETERMINAR AS DATA ENTREGA DOCUMENTOS CARTÓRIO

                DATA ENTREGA DOCUMENTOS CARTÓRIO  = 5 DIAS ÚTEIS A PARTIR DA DATA DE ENTREGA DOS DOCUMENTOS AO DESPACHANTE
            */
            $dataPrevisaoEntregaDocumentosCartorio = DiasUteisClass::contadorDiasUteis($dataRetiradaDocumentosDespachanteFormatada, 5);

            // CAPTURA OS DADOS DA DEMANDA
            $atualizarContratoLeilaoNegativo = LeilaoNegativo::where('contratoFormatado', $contratoFormatado)->where('contratoAtivo', true)->first();
            $atualizarContratoLeilaoNegativo->idDespachante                     = $request->idDespachante;
            $atualizarContratoLeilaoNegativo->dataRetiradaDocumentosDespachante = $dataRetiradaDocumentosDespachanteFormatada->format('Y-m-d');
            $atualizarContratoLeilaoNegativo->numeroOficioUnidade               = $request->numeroOficioUnidade;
            $atualizarContratoLeilaoNegativo->previsaoEntregaDocumentosCartorio = $dataPrevisaoEntregaDocumentosCartorio;
            $atualizarContratoLeilaoNegativo->statusAverbacao                   = 'ENTREGUE DOC DESPACHANTE';
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
            if ($request->sensibilizarTodosContratosLeilao == 'SIM') {
                self::registraDespachanteNosContratosLeilao($atualizarContratoLeilaoNegativo->dataSegundoLeilao, $atualizarContratoLeilaoNegativo->unidadeResponsavel, $request, $dataPrevisaoEntregaDocumentosCartorio);
            }

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
    public function receberProtocoloCartorio(Request $request, $contratoFormatado)
    {
        // dd($request);
        try {
            DB::beginTransaction();

            // CAPTURA OS DADOS DA DEMANDA
            $atualizarContratoLeilaoNegativo = LeilaoNegativo::where('contratoFormatado', $contratoFormatado)->where('contratoAtivo', true)->first();
            $atualizarContratoLeilaoNegativo->numeroProtocoloCartorio               = $request->numeroProtocoloCartorio;
            $atualizarContratoLeilaoNegativo->codigoAcessoProtocoloCartorio         = $request->codigoAcessoProtocoloCartorio;
            $atualizarContratoLeilaoNegativo->dataPrevistaAnaliseCartorio           = Carbon::createFromFormat('d/m/Y', $request->dataPrevistaAnaliseCartorio);
            $atualizarContratoLeilaoNegativo->statusAverbacao                       = 'AGUARDA PRAZO CRI';
            $atualizarContratoLeilaoNegativo->dataAlteracao                         = date("Y-m-d H:i:s", time());
            
            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $contratoFormatado;
            $historico->tipo            = "REGISTRO";
            $historico->atividade       = "LEILÃO NEGATIVO";
            $historico->observacao      = "PROTOCOLO CARTÓRIO ENTREGUE PELO DESPACHANTE"; 
            $historico->created_at      = date("Y-m-d H:i:s", time());
            $historico->updated_at      = date("Y-m-d H:i:s", time());
            $historico->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $atualizarContratoLeilaoNegativo->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Registro realizado!");
            $request->session()->flash('corpoMensagem', "O registro referente a entrega do protocolo do cartório foi cadastrado com sucesso.");

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
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro da entrega do protocolo do cartório. Tente novamente");
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
        // dd($request);
        try {
            DB::beginTransaction();

            // CAPTURA OS DADOS DA DEMANDA
            $atualizarContratoLeilaoNegativo = LeilaoNegativo::where('contratoFormatado', $contratoFormatado)->where('contratoAtivo', true)->first();
            $atualizarContratoLeilaoNegativo->dataRetiradaDocumentoCartorio         = !in_array($request->dataRetiradaDocumentoCartorio, [null, 'NULL', '']) ? Carbon::createFromFormat('d/m/Y', $request->dataRetiradaDocumentoCartorio) : $request->dataRetiradaDocumentoCartorio;
            $atualizarContratoLeilaoNegativo->dataEntregaAverbacaoExigenciaUnidade  = !in_array($request->dataEntregaAverbacaoExigenciaUnidade, [null, 'NULL', '']) ? Carbon::createFromFormat('d/m/Y', $request->dataEntregaAverbacaoExigenciaUnidade) : $request->dataEntregaAverbacaoExigenciaUnidade;
            $atualizarContratoLeilaoNegativo->existeExigencia                       = !in_array($request->existeExigencia, [null, 'NULL', '']) ? $request->existeExigencia : null;
            $atualizarContratoLeilaoNegativo->dataAlteracao                         = date("Y-m-d H:i:s", time());

            if ($request->existeExigencia == 'SIM') {
                $atualizarContratoLeilaoNegativo->statusAverbacao                   = 'AGUARDA DOC GILIESP';
            } else {
                $atualizarContratoLeilaoNegativo->statusAverbacao                   = 'AVERBACAO CONCLUIDA';
            }

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula       = session('matricula');
            $historico->numeroContrato  = $contratoFormatado;
            $historico->tipo            = "REGISTRO";
            $historico->atividade       = "LEILÃO NEGATIVO";
            $historico->observacao      = !in_array($request->observacao, [null, 'NULL', '']) ? mb_convert_case(strip_tags($request->observacao), MB_CASE_UPPER, 'UTF-8') : "DOCUMENTOS RECEBIDOS PELO DESPACHANTE"; 
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

    public static function editarDadosCadastraisTodosContratosLeilao($objLeilaoNegativo, $request) 
    {
        try {
            DB::beginTransaction();
            // AJUSTAR A DATA QUE ESTÁ VINDO DO FRONT
            $dataPrevisaoRecebimentoDocumentosLeiloeiro             = Carbon::createFromFormat('d/m/Y', $request->previsaoRecebimentoDocumentosLeiloeiro);
            $dataPrevisaoDisponibilizacaoDocumentosAoDespachante    = Carbon::createFromFormat('d/m/Y', $request->previsaoDisponibilizacaoDocumentosAoDespachante);

            $contratosLeilao = LeilaoNegativo::where('dataSegundoLeilao', $objLeilaoNegativo->dataSegundoLeilao)->where('unidadeResponsavel', $objLeilaoNegativo->unidadeResponsavel)->where('contratoAtivo', true)->get();
            foreach ($contratosLeilao as $contrato) {
                $contrato->numeroLeilao                                     = !in_array($request->numeroLeilao, [null, 'NULL', '']) ? $request->numeroLeilao : $atualizarContratoLeilaoNegativo->numeroLeilao;
                $contrato->previsaoRecebimentoDocumentosLeiloeiro           = !in_array($dataPrevisaoRecebimentoDocumentosLeiloeiro, [null, 'NULL', '']) ? $dataPrevisaoRecebimentoDocumentosLeiloeiro->format('Y-m-d') : $atualizarContratoLeilaoNegativo->previsaoRecebimentoDocumentosLeiloeiro;    
                $contrato->previsaoDisponibilizacaoDocumentosAoDespachante  = !in_array($dataPrevisaoDisponibilizacaoDocumentosAoDespachante, [null, 'NULL', '']) ? $dataPrevisaoDisponibilizacaoDocumentosAoDespachante->format('Y-m-d') : $atualizarContratoLeilaoNegativo->previsaoDisponibilizacaoDocumentosAoDespachante;
                $contrato->dataAlteracao                                    = date("Y-m-d H:i:s", time());
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

    public static function registraLeiloeiroNosContratosLeilao($dataSegundoLeilao, $unidadeResponsavel, $request) 
    {
        try {
            DB::beginTransaction();
            // AJUSTAR A DATA QUE ESTÁ VINDO DO FRONT
            $dataEntregaDocumentosLeiloeiroFormatada = Carbon::createFromFormat('d/m/Y', $request->dataEntregaDocumentosLeiloeiro);

            $contratosLeilao = LeilaoNegativo::where('dataSegundoLeilao', $dataSegundoLeilao)->where('unidadeResponsavel', $unidadeResponsavel)->get();
            foreach ($contratosLeilao as $contrato) {
                $contrato->idLeiloeiro                       = $request->idLeiloeiro;
                $contrato->dataEntregaDocumentosLeiloeiro    = $dataEntregaDocumentosLeiloeiroFormatada;
                $contrato->statusAverbacao                   = 'RECEBIDO DOC LEILOEIRO';
                $contrato->dataAlteracao                     = date("Y-m-d H:i:s", time());
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

    public static function registraDespachanteNosContratosLeilao($dataSegundoLeilao, $unidadeResponsavel, $request, $dataPrevisaoEntregaDocumentosCartorio) 
    {
        try {
            DB::beginTransaction();
            // AJUSTAR A DATA QUE ESTÁ VINDO DO FRONT
            $dataRetiradaDocumentosDespachanteFormatada = Carbon::createFromFormat('d/m/Y', $request->dataRetiradaDocumentosDespachante);

            $contratosLeilao = LeilaoNegativo::where('dataSegundoLeilao', $dataSegundoLeilao)->where('unidadeResponsavel', $unidadeResponsavel)->get();
            foreach ($contratosLeilao as $contrato) {
                $contrato->idDespachante                     = $request->idDespachante;
                $contrato->dataRetiradaDocumentosDespachante = $dataRetiradaDocumentosDespachanteFormatada;
                $contrato->numeroOficioUnidade               = $request->numeroOficioUnidade;
                $contrato->previsaoEntregaDocumentosCartorio = $dataPrevisaoEntregaDocumentosCartorio;
                $contrato->statusAverbacao                   = 'ENTREGUE DOC DESPACHANTE';
                $contrato->dataAlteracao                     = date("Y-m-d H:i:s", time());
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

    public function registrarHistoricoLeilaoNegativo (Request $request, $numeroContratoFormatado)
    {        
        try {
            DB::beginTransaction();

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $numeroContratoFormatado;
            $historico->tipo = $request->tipoAtendimento;
            $historico->atividade = $request->atividadeAtendimento;
            $historico->observacao = strip_tags($request->observacaoAtendimento);
            // dd(date("Y-m-d H:i:s", time()));
            $historico->created_at = date("Y-m-d H:i:s", time());
            $historico->updated_at = date("Y-m-d H:i:s", time());
            
            $historico->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Histórico registrado!");
            $request->session()->flash('corpoMensagem', "O seu registro de histórico foi cadastrado com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            // dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Histórico não registrado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro do histórico. Tente novamente");
        }
        return redirect("/estoque-imoveis/leiloes-negativos/tratar/" . $numeroContratoFormatado);
    }

    public function criaPlanilhaExcelLeilaoNegativo()
    {

        return Excel::download(new CriaExcelLeilaoNegativo, 'PlanilhaLeiloesNegativo.xlsx');
    }

    public function CodigoCorreio($numeroContratoFormatado)
    {
        $codigo = Codigo_correio_leilaoNegativo::where('contratoFormatado', $numeroContratoFormatado)->get();
        
        return json_encode($codigo);
        
    }
    public function SalvarCodigoCorreio(Request $request)
    {
        $codigo = new Codigo_correio_leilaoNegativo();
        $codigo->codigoDoCorreio   = $request->input('codigoDoCorreio');
        $codigo->contratoFormatado = $request->input('contratoFormatado');
        $codigo->save();

        $request->session()->flash('corMensagem', 'success');
        $request->session()->flash('tituloMensagem', "Código de Rastreamento Cadastrado");
        $request->session()->flash('corpoMensagem', "O seu registro foi cadastrado com sucesso.");
    
        return redirect("/estoque-imoveis/leiloes-negativos/tratar/" . $codigo->contratoFormatado);
    }

    public function importaExcel()
    {
        return view('portal.imoveis.leiloes.import-excel');
    }

    public function ProcessaImportacao()
    {
        $primeira_linha = true;

        if (!empty($_FILES['arquivo']['tmp_name'])){
            $arquivo = new DOMDocument();
            $arquivo->load($_FILES['arquivo']['tmp_name']);


            $linhas = $arquivo->getElementsByTagName("Row");
            foreach ($linhas as $linha){
               if ($primeira_linha == false){
                $nome = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                $Matricula = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                $funcao = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                
                $upload = new TabelaImportExcel();
                $upload->Nome = $nome;
                $upload->Matricula = $Matricula;
                $upload->funcao = $funcao;
                $upload->save();
               }
            $primeira_linha = false;
            }
            return view('portal.imoveis.leiloes.import-excel');;
        }
    }
    public function listaUpload()
    {
        $upload = TabelaImportExcel::all();
        return json_encode($upload);
    }
}
