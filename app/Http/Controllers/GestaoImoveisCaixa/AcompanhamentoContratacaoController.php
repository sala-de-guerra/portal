<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\GestaoImoveisCaixa\ConformidadeContratacao;
use App\Models\BaseSimov;
use App\Models\HistoricoPortalGilie;
use App\Models\GestaoImoveisCaixa\AcompanhamentoContratacao;
use App\Models\GestaoImoveisCaixa\PainelDeVendasGeipt;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AcompanhamentoContratacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultaContratosContratacaoSessentaDias()
    {
        return view('portal.imoveis.contratacao.acompanhamento-contratacao');
    }

    public static function listarContratosContratacaoUltimosSessentaDias()
    {
        $codigoUnidadeLotacaoEmpregadoSessao = session('codigoLotacaoFisica') == null ? session('codigoLotacaoAdministrativa') : session('codigoLotacaoFisica');
        switch ($codigoUnidadeLotacaoEmpregadoSessao) {
            case '7257':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/SP';
                break;
            case '7244':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/BH';
                break;
            case '7243':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/BE';
                break;
            case '7109':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/BR';
                break;
            case '7247':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/CT';
                break;
            case '7248':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/FO';
                break;
            case '7249':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/GO';
                break;
            case '7251':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/PO';
                break;
            case '7254':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/RJ';
                break;
            case '7253':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/RE';
                break;
            case '7255':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/SA';
                break;
            case '7242':
                $nomeUnidadeLotacaoEmpregadoSessao = 'GILIE/BU';
                break;
        }

        $universoContratosContratacao = BaseSimov::where(function($statusImovel) {
                                                        $statusImovel->where('STATUS_IMOVEL', '=', 'Em Contratação')
                                                                    ->orWhere('STATUS_IMOVEL', '=', 'Contratação Pendente');
                                                    })
                                                    ->where('UNA', '=', $nomeUnidadeLotacaoEmpregadoSessao)
                                                    ->get();
        // dd($universoContratosContratacao->conformidadeContratacao->cardAgrupamento);
        $arrayContratosContratacaoUltimosSessentaDias = [];
        // $contadorFalso = 0;
        // $contadorVerdadeiro = 0;
        foreach ($universoContratosContratacao as $contrato) {
            if (Carbon::parse($contrato->DATA_PROPOSTA)->diffInDays(Carbon::now()) > 10 ) { //&& Carbon::parse($contrato->DATA_PROPOSTA)->diffInDays(Carbon::now()) <= 60

                // VALIDA SE JA EXISTE ANALISE NA TABELA AUXILIAR, CASO POSITIVO RECUPERA OS DADOS, CASO NEGATIVO CRIA UM NOVO REGISTRO PENDENTE
                $demandaAcompanhamentoContratacao = AcompanhamentoContratacao::firstOrCreate(['numeroContrato' => $contrato->NU_BEM, 'nomeProponente' => $contrato->NOME_PROPONENTE, 'cpfCnpjProponente' => $contrato->CPF_CNPJ_PROPONENTE]);
                $demandaAcompanhamentoContratacao->statusAcompanhamentoContratacao = isset($demandaAcompanhamentoContratacao->statusAcompanhamentoContratacao) ? $demandaAcompanhamentoContratacao->statusAcompanhamentoContratacao : 'PENDENTE';
                $demandaAcompanhamentoContratacao->created_at = $demandaAcompanhamentoContratacao->created_at != null ? $demandaAcompanhamentoContratacao->created_at : date("Y-m-d H:i:s", time());
                $demandaAcompanhamentoContratacao->updated_at = $demandaAcompanhamentoContratacao->updated_at != null ? $demandaAcompanhamentoContratacao->updated_at : date("Y-m-d H:i:s", time());

                array_push($arrayContratosContratacaoUltimosSessentaDias, [
                    'idAcompanhamentoContratacao' => $demandaAcompanhamentoContratacao->idAcompanhamentoContratacao,
                    'statusAcompanhamentoContratacao' => $demandaAcompanhamentoContratacao->statusAcompanhamentoContratacao,
                    'contratoFormatado' => $contrato->BEM_FORMATADO,
                    'numeroContrato' => $contrato->NU_BEM,
                    'classificacaoImovel' => $contrato->CLASSIFICACAO,
                    'statusImovel' => $contrato->STATUS_IMOVEL,
                    'dataProposta' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
                    'quantidadeDiasAposProposta' => Carbon::parse($contrato->DATA_PROPOSTA)->diffInDays(Carbon::now()),
                    'nomeProponente' => strtoupper($contrato->NOME_PROPONENTE),
                    'cpfCnpjProponente' => $contrato->CPF_CNPJ_PROPONENTE,
                    'tipoVenda' => $contrato->TIPO_VENDA,
                    'cardAgrupamentoContratacao' => isset($contrato->conformidadeContratacao->cardDeAgrupamento) ? $contrato->conformidadeContratacao->cardDeAgrupamento : '', 
                    'statusConformidadeContratacao' => isset($contrato->conformidadeContratacao->nomeStatusDoDossie) ? $contrato->conformidadeContratacao->nomeStatusDoDossie : '',
                ]);

                $demandaAcompanhamentoContratacao->save();
                // $contadorVerdadeiro++;
            } else {
                // $contadorFalso++;
            }
        }
        // dd(['contadorFalso' => $contadorFalso, 'contadorVerdadeiro' => $contadorVerdadeiro]);
        return json_encode($arrayContratosContratacaoUltimosSessentaDias);
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
    public function atualizaAcompanhamentoContratacao(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $constratoAnalisado = AcompanhamentoContratacao::find($id);
            $constratoAnalisado->statusAcompanhamentoContratacao = $request->statusAcompanhamentoContratacao;
            $constratoAnalisado->matriculaAnalista = session('matricula');
            $constratoAnalisado->updated_at = date("Y-m-d H:i:s", time());

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $request->contratoFormatado;
            $historico->tipo = "ACOMPANHAMENTO";
            $historico->atividade = "CONTRATACAO";
            $historico->observacao = "Analisado pagamento visando baixa de venda no SIACI/CIWEB/GCE e baixa no SIMOV";
            $historico->created_at = date("Y-m-d H:i:s", time());
            $historico->updated_at = date("Y-m-d H:i:s", time());
            $historico->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Análise efetuada");
            $request->session()->flash('corpoMensagem', "Análise efetuada com sucesso!");

            $constratoAnalisado->save();
            DB::commit();
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Análise não efetuada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro da análise. Tente novamente");
        }
        return redirect("/estoque-imoveis/acompanha-contratacao");
    }
}
