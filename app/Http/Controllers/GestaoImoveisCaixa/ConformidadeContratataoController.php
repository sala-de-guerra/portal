<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Http\Controllers\Controller;
use App\Models\GestaoImoveisCaixa\ConformidadeContratacao;
use App\Models\BaseSimov;
use App\Models\GestaoImoveisCaixa\PainelDeVendasGeipt;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ConformidadeContratataoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.imoveis.contratacao.controle-conformidade');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarContratosConformidade()
    {
        $arrayContratosConformidade = [];
        $consultaContratosConformidade = DB::table('ADJTBL_imoveisCaixa')
                                            ->join('ALITB075_VENDA_VL_OL37', 'ADJTBL_imoveisCaixa.numeroContrato', '=', 'ALITB075_VENDA_VL_OL37.NU_BEM')
                                            ->join('ALITB001_Imovel_Completo', 'ADJTBL_imoveisCaixa.numeroContrato', '=', 'ALITB001_Imovel_Completo.NU_BEM')
                                            ->select(DB::raw('
                                                ALITB001_Imovel_Completo.[BEM_FORMATADO] as contratoFormatado,
                                                ALITB001_Imovel_Completo.[ACEITA_CCA] as aceitaCca, 
                                                ALITB001_Imovel_Completo.[CLASSIFICACAO] as classificacaoImovel, 
                                                ADJTBL_imoveisCaixa.numeroContrato, 
                                                ADJTBL_imoveisCaixa.codigoAgencia,
                                                ALITB001_Imovel_Completo.[VALOR_REC_PROPRIOS_PROPOSTA] as valorRecursosPropriosProposta,
                                                ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as valorTotalProposta,
                                                ALITB001_Imovel_Completo.[VALOR_FGTS_PROPOSTA] as valorFgtsProposta,
                                                ALITB001_Imovel_Completo.[VALOR_FINANCIADO_PROPOSTA] as valorFinanciadoProposta,
                                                ADJTBL_imoveisCaixa.[tipoDeContratacao] as tipoContratacao,
                                                ALITB001_Imovel_Completo.[TIPO_VENDA] as tipoVenda,
                                                ADJTBL_imoveisCaixa.[nomeStatusDoDossie] as statusContratacao,
                                                ADJTBL_imoveisCaixa.[cardDeAgrupamento] as cardAgrupamento,
                                                CONVERT(VARCHAR, ADJTBL_imoveisCaixa.[dataStatus], 103) as dataStatus,
                                                CONVERT(VARCHAR, ADJTBL_imoveisCaixa.[dataSimov], 103) as dataSimov,
                                                ALITB075_VENDA_VL_OL37.[VL_TOTAL_RECEBIDO] as valorTotalRecebido
                                            '))
                                            ->where('ADJTBL_imoveisCaixa.codigoGilie', '7257')
                                            ->where(function($cardAgrupamento) {
                                                $cardAgrupamento->where('ADJTBL_imoveisCaixa.cardDeAgrupamento', '!=', 'Negócios Realizados')
                                                        ->where('ADJTBL_imoveisCaixa.cardDeAgrupamento', '!=', 'CICOB');
                                            })
                                            ->where(function($statusSimov) {
                                                $statusSimov->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', 'Em Contratação')
                                                        ->orWhere('ALITB001_Imovel_Completo.STATUS_IMOVEL', 'Contratação pendente');
                                            })
                                            ->get();
        $arrayContratosParaRemoverRepetidos = [];
        foreach ($consultaContratosConformidade as $contrato) {
            if (!in_array($contrato->numeroContrato, $arrayContratosParaRemoverRepetidos)) {
                switch ($contrato->aceitaCca) {
                    case 'Sim':
                    case 'SIM':
                        $fluxoContratacao = 'CCA';
                        break;
                    default:
                        $fluxoContratacao = 'AG';
                        break;
                }
                switch ($contrato->classificacaoImovel) {
                    case 'Em Cadastramento EMGEA':
                    case 'EMGEA':
                    case 'EMGEA - Realização de Garantia':
                    case 'EMGEA- Alienação Fiduciária': 
                        $classificacaoImovel = 'EMGEA';
                        break;
                    case 'Oriundo do Crédito Imobiliário':
                    case 'Oriundos SFI-Gar. Fiduciária':
                    case 'SFI - Gar.Fid.Reg.Créd.Imob':
                        $classificacaoImovel = 'CAIXA';
                        break;
                    case 'Patrimonial':
                    case 'Patrimonial - Alienação Fiduciária':
                    case 'Patrimonial -Realização de Garantia':
                        $classificacaoImovel = 'PATRIMONIAL';
                        break;
                    default:
                        $classificacaoImovel = $contrato->classificacaoImovel;
                        break;
                }

                if ($contrato->valorRecursosPropriosProposta == $contrato->valorTotalProposta) {
                    $tipoProposta = 'A vista com recursos proprios';
                } elseif (($contrato->valorFgtsProposta + $contrato->valorRecursosPropriosProposta) == $contrato->valorTotalProposta) {
                    $tipoProposta = 'A vista com FGTS';
                } else {
                    $tipoProposta = 'Financiado';
                }
    
                if ($contrato->valorTotalRecebido >= $contrato->valorRecursosPropriosProposta) {
                    $sinalPago = 'SIM';
                } else {
                    $sinalPago = 'NAO';
                }
                
                array_push($arrayContratosConformidade, [
                    'contratoFormatado' => $contrato->contratoFormatado,
                    'numeroContrato' => $contrato->numeroContrato,
                    'fluxoContratacao' => $fluxoContratacao, 
                    'codigoAgencia' => $contrato->codigoAgencia,
                    'tipoVenda' => $contrato->tipoVenda,
                    'tipoProposta' => $tipoProposta,
                    'valorRecursosProprios' => $contrato->valorRecursosPropriosProposta,
                    'valorTotalRecebido' => $contrato->valorTotalRecebido,
                    'sinalPago' => $sinalPago,
                    'statusContratacao' => $contrato->statusContratacao,
                    'cardAgrupamento' => $contrato->cardAgrupamento,
                    'dataEntradaConformidade' => $contrato->dataStatus,
                    'classificacaoImovel' => $classificacaoImovel,
                ]);
                array_push($arrayContratosParaRemoverRepetidos, $contrato->numeroContrato);
            }
        }
        return json_encode($arrayContratosConformidade, JSON_UNESCAPED_UNICODE);
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultaContratosContratacaoSessentaDias()
    {
        return view('portal.imoveis.contratacao.acompanhamento-contratacao');
    }

    public static function acompanhaContratacao()
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
            if (Carbon::parse($contrato->DATA_PROPOSTA)->diffInDays(Carbon::now()) <= 60) {
                array_push($arrayContratosContratacaoUltimosSessentaDias, [
                    'contratoFormatado' => $contrato->BEM_FORMATADO,
                    'numeroContrato' => $contrato->NU_BEM,
                    'classificacaoImovel' => $contrato->CLASSIFICACAO,
                    'statusImovel' => $contrato->STATUS_IMOVEL,
                    'dataProposta' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
                    'quantidadeDiasAposProposta' => Carbon::parse($contrato->DATA_PROPOSTA)->diffInDays(Carbon::now()),
                    'nomeProponente' => $contrato->NOME_PROPONENTE,
                    'cpfCnpjProponente' => $contrato->CPF_CNPJ_PROPONENTE,
                    'tipoVenda' => $contrato->TIPO_VENDA,
                    'cardAgrupamentoContratacao' => isset($contrato->conformidadeContratacao->cardDeAgrupamento) ? $contrato->conformidadeContratacao->cardDeAgrupamento : '', 
                    'statusConformidadeContratacao' => isset($contrato->conformidadeContratacao->nomeStatusDoDossie) ? $contrato->conformidadeContratacao->nomeStatusDoDossie : '',
                ]);
                // $contadorVerdadeiro++;
            } else {
                // $contadorFalso++;
            }
        }
        // dd(['contadorFalso' => $contadorFalso, 'contadorVerdadeiro' => $contadorVerdadeiro]);
        return json_encode($arrayContratosContratacaoUltimosSessentaDias);
    }
}
