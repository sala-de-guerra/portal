<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GestaoImoveisCaixa\DistratoDemanda;
use App\Models\GestaoImoveisCaixa\DistratoRelacaoDespesas;
use App\Models\HistoricoPortalGilie;
use App\Models\BaseSimov;
use App\Models\PropostasSimov;
use App\Classes\GestaoImoveisCaixa\DistratoPhpMailer;
use App\Models\ControleMensageria;
use App\Models\RelacaoAgSrComEmail;

class DistratoDemandaController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        return view('portal.imoveis.distrato.controle-distrato');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarDemanda(Request $request)
    {
        try {
            DB::beginTransaction();
            $dadosProposta = PropostasSimov::where('NÚMERO BEM', $request->contratoFormatado)->where('NOME PROPONENTE', $request->nomeProponente)->first();
            $dadosSimov = BaseSimov::where('BEM_FORMATADO', $request->contratoFormatado)->first();
            $dadosAgencia = RelacaoAgSrComEmail::where('nomeAgencia', $dadosSimov->AGENCIA_CONTRATACAO_PROPOSTA)->first();

            // VALIDA SE EXISTE AGÊNCIA DE CONTRATAÇÃO
            if ($dadosAgencia == null || $dadosAgencia == 'NULL') {
                $codigoAgenciaContratacao = null;
                $nomeAgenciaContratacao = null;
                $emailAgenciaContratacao = null;
            } else {
                $codigoAgenciaContratacao = $dadosAgencia->codigoAgencia;
                $nomeAgenciaContratacao = $dadosAgencia->nomeAgencia;
                $emailAgenciaContratacao = $dadosAgencia->emailAgencia;
            }
            
            // VALIDA SE EXISTE PROPOSTA CADASTRADA NA BASE DE DADOS DA GEIPT E VERIFICA SE EXISTE TELEFONE E E-MAIL
            if ( $dadosProposta == null || $dadosProposta == 'NULL') {
                $telefone = 'telefone não cadastrado';
                $emailProponente = 'e-mail não cadastrado';
            } else {
                if ($dadosProposta->{'DDD PROPONENTE'} == null || $dadosProposta->{'DDD PROPONENTE'} == 'NULL') {
                    $telefone = 'telefone não cadastrado';
                } else {
                    $telefone = "(" . $dadosProposta->{'DDD PROPONENTE'} . ") " . $dadosProposta->{'TELEFONE PROPONENTE'};
                }
                if ($dadosProposta->{'E-MAIL PROPONENTE'} == null || $dadosProposta->{'E-MAIL PROPONENTE'} == 'NULL') {
                    $emailProponente = 'e-mail não cadastrado';
                } else {
                    $emailProponente = $dadosProposta->{'E-MAIL PROPONENTE'};
                }
            }
            
            $novoDistrato = new DistratoDemanda;
            $novoDistrato->contratoFormatado = $request->contratoFormatado;
            $novoDistrato->nomeProponente = strtoupper ($request->nomeProponente);
            $novoDistrato->cpfCnpjProponente = $request->cpfCnpjProponente;
            $novoDistrato->statusAnaliseDistrato = 'CADASTRADA';
            $novoDistrato->motivoDistrato = 'A CLASSIFICAR';
            $novoDistrato->telefoneProponente = $telefone;
            $novoDistrato->emailProponente = $emailProponente;
            $novoDistrato->tipoVendaProposta = $dadosSimov->TIPO_VENDA;
            $novoDistrato->valorRecursosPropriosProposta = $dadosSimov->VALOR_REC_PROPRIOS_PROPOSTA;
            $novoDistrato->valorFgtsProposta = $dadosSimov->VALOR_FGTS_PROPOSTA;
            $novoDistrato->valorFinanciadoProposta = $dadosSimov->VALOR_FINANCIADO_PROPOSTA;
            $novoDistrato->valorParceladoProposta = $dadosSimov->VALOR_PARCELADO_PROPOSTA;
            $novoDistrato->valorTotalProposta = $dadosSimov->VALOR_TOTAL_PROPOSTA;
            $novoDistrato->codigoAgenciaContratacao = $codigoAgenciaContratacao;
            $novoDistrato->dataProposta = $dadosSimov->DATA_PROPOSTA;
            $novoDistrato->nomeCorretor = $dadosSimov->NO_CORRETOR;
            $novoDistrato->emailCorretor = $dadosSimov->EMAIL_CORRETOR;
            $novoDistrato->demandaAtiva = 'SIM';

            // ENVIA E-MAIL DE CONFIRMAÇÃO DE CADASTRO DE DEMANDA
            DistratoPhpMailer::enviarMensageria($novoDistrato, 'notificacaoCadastroDistrato');

            $controleMensageriaDistrato = new ControleMensageria;
            $controleMensageriaDistrato->tipoMensagem = 'CADASTRO DE DISTRATO';
            $controleMensageriaDistrato->numeroContrato = $novoDistrato->contratoFormatado;
            $controleMensageriaDistrato->codigoAgencia = $novoDistrato->codigoAgenciaContratacao;
            $controleMensageriaDistrato->emailCorretor = $novoDistrato->emailCorretor;
            $controleMensageriaDistrato->emailProponente = $novoDistrato->emailProponente;
            $controleMensageriaDistrato->save();

            // PERSISTE OS DADOS DO DISTRATO SOMENTE NO FIM DO MÉTODO
            $novoDistrato->save();

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $request->contratoFormatado;
            $historico->tipo = "CADASTRO";
            $historico->atividade = "DISTRATO";
            $historico->observacao = "CADASTRO DE DISTRATO - PROTOCOLO: #" . str_pad($novoDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " - PROPONENTE: " . $request->nomeProponente;
            $historico->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Distrato cadastrado!");
            $request->session()->flash('corpoMensagem', "O protocolo #" . str_pad($novoDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " foi cadastrado com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Cadastro não efetuado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o cadastro da demanda. Tente novamente");
        }
        return redirect('/estoque-imoveis/distrato');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function listarDemandas()
    {
        $universoProtocolosDistrato = DistratoDemanda::select('idDistrato', 'contratoFormatado', 'nomeProponente', 'statusAnaliseDistrato', 'motivoDistrato', 'created_at')->get();
        return json_encode($universoProtocolosDistrato);
    }

    /**
     *
     * @param  string  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function visualizarDemanda($contratoFormatado)
    {
        return view('portal.imoveis.distrato.operacional-distrato')->with('numeroContrato', $contratoFormatado);
    }

    /**
     * Apresenta json com dados do distrato para view de ação dos distratos
     *
     * @param  int  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function jsonDadosDemanda($contratoFormatado)
    {
        $demandaDistrato = DistratoDemanda::where('contratoFormatado', $contratoFormatado)->get();

        $arrayGrupoDemandasDistrato = [];
        
        // PASSA POR TODAS AS SOLICITAÇÕES DE DISTRATO DO CONTRATO (CASO HAJA MAIS DE UM CASO)
        foreach ($demandaDistrato as $demanda) {
           
            // MONTA O ARRAY DA DEMANDA COM SOMENTE OS CAMPOS NECESSÁRIOS PARA A VIEW
            $arrayDemanda = [
                'idDistrato' => $demanda->idDistrato,
                'nomeProponente' => $demanda->nomeProponente,
                'cpfCnpjProponente' => $demanda->cpfCnpjProponente,
                'telefoneProponente' => $demanda->telefoneProponente,
                'emailProponente' => $demanda->emailProponente,
                'modalidadeProposta' => $demanda->tipoVendaProposta,
                'dataCadastro' => $demanda->created_at == null ? '' : $demanda->created_at->format('yy-m-d h:i:s'),
                'motivoDistrato' => $demanda->motivoDistrato,
                'statusAnaliseDistrato' => $demanda->statusAnaliseDistrato,
                'observacaoDistrato' => $demanda->observacaoDistrato == null ? '' : $demanda->observacaoDistrato,
                'parecerAnalista' => $demanda->parecerAnalista,
                'matriculaAnalista' => $demanda->matriculaAnalista,
                'valorTotalProposta' => $demanda->valorTotalProposta,
                'valorRecursosPropriosProposta' => $demanda->valorRecursosPropriosProposta,
                'valorFgtsProposta' => $demanda->valorFgtsProposta,
                'valorFinanciadoProposta' => $demanda->valorFinanciadoProposta,
                'valorParceladoProposta' => $demanda->valorParceladoProposta,
            ];
            // AGRUPA TODAS AS DEMANDAS EM UM ÚNICO ARRAY
            array_push($arrayGrupoDemandasDistrato, $arrayDemanda);
        }
        return json_encode($arrayGrupoDemandasDistrato);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idDistrato
     * @return \Illuminate\Http\Response
     */
    public function analisarDemanda(Request $request, $idDistrato)
    {       
        try {
            DB::beginTransaction();
            // ATUALIZA DEMANDA
            $demandaDistrato = DistratoDemanda::find($idDistrato);
            // VALIDA SE OS INPUTS ESTÃO VINDO NULL, CASO POSITIVO MANTER O STATUS ANTERIOR
            $demandaDistrato->motivoDistrato = $request->input('motivoDistrato') == null ? $demandaDistrato->motivoDistrato : $request->input('motivoDistrato');
            $demandaDistrato->observacaoDistrato = $request->input('observacaoDistrato');
            $demandaDistrato->matriculaAnalista = session('matricula');
            
            // RESGATA DADOS DO CONTRATO
            $dadosSimov = BaseSimov::where('BEM_FORMATADO', $demandaDistrato->contratoFormatado)->first();

            // SOLICITA AUTORIZAÇÃO PARA EMGEA EM CASO DE IMÓVEIS EMGEA/EMGEA
            if ($dadosSimov->ORIGEM_MATRICULA == 'Emgea') {
                # CODIGO PARA MANDAR E-MAIL DE AUTORIZAÇÃO PARA EMGEA
                DistratoPhpMailer::enviarMensageria($demandaDistrato, 'pedidoAutorizacaoEmgea');

                $controleMensageriaDistrato = new ControleMensageria;
                $controleMensageriaDistrato->tipoMensagem = 'DISTRATO - PEDIDO DE AUTORIZAÇÃO EMGEA';
                $controleMensageriaDistrato->numeroContrato = $demandaDistrato->contratoFormatado;
                $controleMensageriaDistrato->codigoAgencia = $demandaDistrato->codigoAgenciaContratacao;
                $controleMensageriaDistrato->emailCorretor = $demandaDistrato->emailCorretor;
                $controleMensageriaDistrato->emailProponente = $demandaDistrato->emailProponente;
                $controleMensageriaDistrato->save();

                $demandaDistrato->statusAnaliseDistrato = 'AGUARDA AUTORIZACAO EMGEA';
            }

            // VALIDA A RESPONSABILIDADE DO DISTRATO COM BASE NO MOTIVO 
            switch ($demandaDistrato->motivoDistrato) {
                // RESPONSABILIDADE CLIENTE

                case 'ACAO JUDICIAL NAO IMPEDITIVA':
                case 'CREDITO NAO APROVADO':
                case 'DESISTENCIA':
                    $demandaDistrato->statusAnaliseDistrato = 'EM ANALISE';
                    break;

                // RESPONSABILIDADE CAIXA
                case 'ACAO JUDICIAL IMPEDITIVA':
                case 'DIREITO DE PREFERENCIA DO EX-MUTUARIO':
                case 'ERRO FORMAL DE EDITAL':
                case 'LEILOES NEGATIVOS':
                case 'IMPOSSIBILIDADE DE REGISTRO DE AQUISICAO LEILOES NEGATIVOS':
                    // ENVIAR MENSAGEM SOLICITANDO DOCUMENTOS
                    if ($demandaDistrato->emailSolicitandoDocumentacaoParaPagamento != 'SIM') {
                        # ENVIAR MENSAGEM PEDINDO COMPROVANTES DE PAGAMENTO PARA ANÁLISE DE REEMBOLSO
                        DistratoPhpMailer::enviarMensageria($demandaDistrato, 'solicitacaoDocumentosReembolso');

                        $controleMensageriaDistrato = new ControleMensageria;
                        $controleMensageriaDistrato->tipoMensagem = 'DISTRATO - PEDIDO DE COMPROVANTES PAGAMENTO';
                        $controleMensageriaDistrato->numeroContrato = $demandaDistrato->contratoFormatado;
                        $controleMensageriaDistrato->codigoAgencia = $demandaDistrato->codigoAgenciaContratacao;
                        $controleMensageriaDistrato->emailCorretor = $demandaDistrato->emailCorretor;
                        $controleMensageriaDistrato->emailProponente = $demandaDistrato->emailProponente;
                        $controleMensageriaDistrato->save();
                    }
                    $demandaDistrato->statusAnaliseDistrato = 'AGUARDA DOCUMENTOS CLIENTE';
                    break;
                case 'DISTRATO CANCELADO':
                    $demandaDistrato->statusAnaliseDistrato = 'CANCELADA';
                    break;
            }

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $demandaDistrato->contratoFormatado;
            $historico->tipo = "ANALISE";
            $historico->atividade = "DISTRATO";
            $historico->observacao = "DISTRATO #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " - STATUS: $demandaDistrato->statusAnaliseDistrato - MOTIVO: $demandaDistrato->motivoDistrato - OBSERVAÇÃO: $request->observacaoDistrato";
            $historico->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Análise realizada!");
            $request->session()->flash('corpoMensagem', "A análise da demanda #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " foi realizada com sucesso.");

            // SÓ PERSISTE OS DADOS NO BANCO QUANDO ACABAREM TODAS AS AÇÕES DO MÉTODO
            $demandaDistrato->save();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Análise não efetuada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro da análise. Tente novamente");
        }
        return redirect("/estoque-imoveis/distrato/tratar/" . $demandaDistrato->contratoFormatado);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idDistrato
     * @return \Illuminate\Http\Response
     */
    public function alterarDemanda(Request $request, $idDistrato)
    {       
        try {
            DB::beginTransaction();
            // ATUALIZA DEMANDA
            $demandaDistrato = DistratoDemanda::find($idDistrato);

            // VALIDA SE OS INPUTS ESTÃO VINDO NULL, CASO POSITIVO MANTER O STATUS ANTERIOR
            $demandaDistrato->motivoDistrato = $request->input('motivoDistrato') == null ? $demandaDistrato->motivoDistrato : $request->input('motivoDistrato');
            $demandaDistrato->statusAnaliseDistrato = $request->input('statusAnaliseDistrato') == null ? $demandaDistrato->statusAnaliseDistrato : $request->input('statusAnaliseDistrato');
            $demandaDistrato->observacaoDistrato = $request->input('observacaoDistrato');
            $demandaDistrato->matriculaAnalista = session('matricula');
            
            // RESGATA DADOS DO CONTRATO
            $dadosSimov = BaseSimov::where('BEM_FORMATADO', $demandaDistrato->contratoFormatado)->first();

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $demandaDistrato->contratoFormatado;
            $historico->tipo = "ALTERAÇÃO";
            $historico->atividade = "DISTRATO";
            $historico->observacao = "DISTRATO #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " - STATUS: $demandaDistrato->statusAnaliseDistrato - MOTIVO: $demandaDistrato->motivoDistrato - OBSERVAÇÃO: $request->observacaoDistrato";
            $historico->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Alteração realizada!");
            $request->session()->flash('corpoMensagem', "A alteração da demanda #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " foi realizada com sucesso.");

            // SÓ PERSISTE OS DADOS NO BANCO QUANDO ACABAREM TODAS AS AÇÕES DO MÉTODO
            $demandaDistrato->save();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Alteração não efetuada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro da alteração. Tente novamente");
        }
        return redirect("/estoque-imoveis/distrato/tratar/" . $demandaDistrato->contratoFormatado);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $demandaDistrato
     * @return \Illuminate\Http\Response
     */
    public function emitirParecerAnalista(Request $request, $idDistrato)
    {       
        try {
            DB::beginTransaction();
            // CAPTURA A DEMANDA DE DISTRATO E RELAÇÃO DE DESPESAS
            $demandaDistrato = DistratoDemanda::find($idDistrato);
            $relacaoDespesasDistrato = DistratoRelacaoDespesas::where('idDistrato', $idDistrato)->get();
            
            // VALIDA SE EXISTE DESPESA CADASTRADA - CASO EXISTA SEGUE COM A EMISSÃO DO PARECER - CASO NEGATIVO VOLTA PRA TELA COM ERRO
            if ($relacaoDespesasDistrato->count() == 0) {
                // FLASH MESSAGE
                $request->session()->flash('corMensagem', 'danger');
                $request->session()->flash('tituloMensagem', "Parecer não efetuado");
                $request->session()->flash('corpoMensagem', "Não existe nenhuma despesa cadastrada, o parecer não pode ser emitido.");
            } else {
                $demandaDistrato->parecerAnalista = $request->input('parecerAnalista');
                $demandaDistrato->matriculaAnalista = session('matricula');
                
                // ENVIA DE FORMA AUTOMÁTICA O PARECER PARA ANALISE DO GESTOR
                DistratoPhpMailer::enviarMensageria($demandaDistrato, 'notificacaoGestorParecerAnalista');
                $demandaDistrato->statusAnaliseDistrato = 'AGUARDA PARECER GESTOR';

                // RETORNA A FLASH MESSAGE
                $request->session()->flash('corMensagem', 'success');
                $request->session()->flash('tituloMensagem', "Parecer emitido!");
                $request->session()->flash('corpoMensagem', "O parecer da demanda #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " foi enviado para apreciação do gestor.");

                // SÓ PERSISTE OS DADOS NO BANCO QUANDO ACABAREM TODAS AS AÇÕES DO MÉTODO
                $demandaDistrato->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Parecer não efetuado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro do parecer. Tente novamente");
        }
        return redirect("/estoque-imoveis/distrato/tratar/" . $demandaDistrato->contratoFormatado);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $demandaDistrato
     * @return \Illuminate\Http\Response
     */
    public function emitirParecerGestor(Request $request, $idDistrato)
    {       
        try {
            DB::beginTransaction();
            // ATUALIZA DEMANDA
            $demandaDistrato = DistratoDemanda::find($idDistrato);
            if ($request->decisaoGerenteDistrato == 'SIM') {
                $demandaDistrato->parecerGestor = $request->input('observacaoDistrato');
                $demandaDistrato->matriculaGestor = session('matricula');
                // $demandaDistrato->isentarMulta = input('isentarMulta');
                
                // ENVIA DE FORMA AUTOMÁTICA O PARECER PARA O CLIENTE/CORRETOR/AGÊNCIA
                $relacaoDespesasDistrato = DistratoRelacaoDespesas::where('idDistrato', $demandaDistrato->idDistrato)->get();
                // dd($relacaoDespesasDistrato);

                $existeMulta = false;
                foreach ($relacaoDespesasDistrato as $despesa => $value) {
                    if ($value->devolucaoPertinente == 'SIM') {
                        if ($value->tipoDespesa == 'MULTA') {
                            $existeMulta = true;
                        }
                    }
                }

                if ($existeMulta == true) {
                    // ENVIAR MENSAGEM DE ORIENTAÇÃO COM MULTA PARA O CLIENTE
                    DistratoPhpMailer::enviarMensageria($demandaDistrato, 'orientacaoClienteDistratoComMulta');

                    $controleMensageriaDistrato = new ControleMensageria;
                    $controleMensageriaDistrato->tipoMensagem = 'DISTRATO - ORIENTACAO CLIENTE COM MULTA';
                    $controleMensageriaDistrato->numeroContrato = $demandaDistrato->contratoFormatado;
                    $controleMensageriaDistrato->codigoAgencia = $demandaDistrato->codigoAgenciaContratacao;
                    $controleMensageriaDistrato->emailCorretor = $demandaDistrato->emailCorretor;
                    $controleMensageriaDistrato->emailProponente = $demandaDistrato->emailProponente;

                    // ENVIAR MENSAGEM DE ORIENTAÇÃO PARA A REDE
                    DistratoPhpMailer::enviarMensageria($demandaDistrato, 'orientacaoAgenciaDistrato');

                    // CADASTRAR ENVIO DE MENSAGERIA
                    $controleMensageriaDistrato = new ControleMensageria;
                    $controleMensageriaDistrato->tipoMensagem = 'DISTRATO - ORIENTACAO CONTÁBIL AGÊNCIA';
                    $controleMensageriaDistrato->numeroContrato = $demandaDistrato->contratoFormatado;
                    $controleMensageriaDistrato->codigoAgencia = $demandaDistrato->codigoAgenciaContratacao;
                    $controleMensageriaDistrato->emailCorretor = $demandaDistrato->emailCorretor;
                    $controleMensageriaDistrato->emailProponente = $demandaDistrato->emailProponente;

                    // CADASTRA HISTÓRICO
                    $historico = new HistoricoPortalGilie;
                    $historico->matricula = session('matricula');
                    $historico->numeroContrato = $demandaDistrato->contratoFormatado;
                    $historico->tipo = "PARECER EMITIDO";
                    $historico->atividade = "DISTRATO";
                    $historico->observacao = "DISTRATO #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " SEGUIRÁ COM COBRANÇA DE MULTA";
                    $historico->save();
                } else {
                    // ENVIAR MENSAGEM DE ORIENTAÇÃO SEM MULTA PARA O CLIENTE
                    DistratoPhpMailer::enviarMensageria($demandaDistrato, 'orientacaoClienteDistratoSemMulta');

                    $controleMensageriaDistrato = new ControleMensageria;
                    $controleMensageriaDistrato->tipoMensagem = 'DISTRATO - ORIENTACAO CLIENTE SEM MULTA';
                    $controleMensageriaDistrato->numeroContrato = $demandaDistrato->contratoFormatado;
                    $controleMensageriaDistrato->codigoAgencia = $demandaDistrato->codigoAgenciaContratacao;
                    $controleMensageriaDistrato->emailCorretor = $demandaDistrato->emailCorretor;
                    $controleMensageriaDistrato->emailProponente = $demandaDistrato->emailProponente;

                    // ENVIAR MENSAGEM DE ORIENTAÇÃO PARA A REDE
                    DistratoPhpMailer::enviarMensageria($demandaDistrato, 'orientacaoAgenciaDistrato');

                    // CADASTRAR ENVIO DE MENSAGERIA
                    $controleMensageriaDistrato = new ControleMensageria;
                    $controleMensageriaDistrato->tipoMensagem = 'DISTRATO - ORIENTACAO CONTÁBIL AGÊNCIA';
                    $controleMensageriaDistrato->numeroContrato = $demandaDistrato->contratoFormatado;
                    $controleMensageriaDistrato->codigoAgencia = $demandaDistrato->codigoAgenciaContratacao;
                    $controleMensageriaDistrato->emailCorretor = $demandaDistrato->emailCorretor;
                    $controleMensageriaDistrato->emailProponente = $demandaDistrato->emailProponente;

                    // CADASTRA HISTÓRICO
                    $historico = new HistoricoPortalGilie;
                    $historico->matricula = session('matricula');
                    $historico->numeroContrato = $demandaDistrato->contratoFormatado;
                    $historico->tipo = "PARECER EMITIDO";
                    $historico->atividade = "DISTRATO";
                    $historico->observacao = "DISTRATO #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " SEGUIRÁ SEM COBRANÇA MULTA";
                    $historico->save();
                }
                $controleMensageriaDistrato->save();
                $demandaDistrato->statusAnaliseDistrato = 'ENCAMINHADO AGENCIA';

                // RETORNA A FLASH MESSAGE
                $request->session()->flash('corMensagem', 'success');
                $request->session()->flash('tituloMensagem', "Parecer emitido!");
                $request->session()->flash('corpoMensagem', "O parecer da demanda #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " foi enviado para a agência com sucesso.");
            } else {
                // CADASTRA HISTÓRICO
                $historico = new HistoricoPortalGilie;
                $historico->matricula = session('matricula');
                $historico->numeroContrato = $demandaDistrato->contratoFormatado;
                $historico->tipo = "DEMANDA CANCELADA";
                $historico->atividade = "DISTRATO";
                $historico->observacao = "DISTRATO #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " FOI CANCELADO POR DETERMINAÇÃO DO GESTOR";
                $historico->save();

                // RETORNA A FLASH MESSAGE
                $request->session()->flash('corMensagem', 'warning');
                $request->session()->flash('tituloMensagem', "Distrato cancelado!");
                $request->session()->flash('corpoMensagem', "A demanda #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " foi cancelada.");

                $demandaDistrato->statusAnaliseDistrato = 'CANCELADA';
            }

            // SÓ PERSISTE OS DADOS NO BANCO QUANDO ACABAREM TODAS AS AÇÕES DO MÉTODO
            $demandaDistrato->save();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Parecer não efetuado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro do parecer. Tente novamente");
        }
        return redirect("/estoque-imoveis/distrato/tratar/" . $demandaDistrato->contratoFormatado);
    }
}