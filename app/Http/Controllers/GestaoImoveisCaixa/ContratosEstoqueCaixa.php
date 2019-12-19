<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaseSimov;

class ContratosEstoqueCaixa extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param int  $contrato
     * @return \Illuminate\Http\Response
     */
    static public function show($numeroContrato, Request $request)
    {
        if (!preg_match("/([0-9]{2})([.]{1})([0-9]{4})([.]{1})([0-9]{7})([-]{1})([0-9]{1})/", $numeroContrato) || $numeroContrato == '00.0000.0000000-0') {
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Busca não efetuada");
            $request->session()->flash('corpoMensagem', "O termo digitado não retornou nenhum resultado. Tente novamente");

            return view('portal.imoveis.pesquisar');
        } else {
            return view('portal.imoveis.consulta-bem-imovel')->with('numeroContrato', $numeroContrato);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int  $contrato
     * @return \Illuminate\Http\Response
     */
    static public function capturaDadosBaseSimov($numeroContrato)
    {
        $contrato = BaseSimov::find($numeroContrato);

        if (is_null($contrato->ACEITA_CCA) || $contrato->ACEITA_CCA == 'Nao' || $contrato->ACEITA_CCA == 'NULL') {
            $fluxoAgenciaOuCca = 'AGÊNCIA';
        } else {
            $fluxoAgenciaOuCca = 'CCA';
        }
        

        $dadosContrato = [
            'bemFormatado' => $numeroContrato,
            'numeroBem' => $contrato->NU_BEM,
            'classificacao' => $contrato->CLASSIFICACAO,
            'dataEntrada' => $contrato->DATA_ENTRADA,
            'cep' => $contrato->CEP,
            'ufImovel' => $contrato->UF,
            'cidadeImovel' => $contrato->CIDADE,
            'nomeEmpreendimento' => $contrato->NOME_EMPREENDIMENTO,
            'bairroImovel' => $contrato->BAIRRO,
            'enderecoImovel' => $contrato->ENDERECO_IMOVEL,
            'tipoImovel' => $contrato->TIPO_IMOVEL,
            'descricaoImovel' => $contrato->DESCRICAO_IMOVEL,
            'descricaoAdicionalImovel' => $contrato->DESCRICAO_ADIC_IMOVEL,


            'agrupamentoLeilao' => $contrato->AGRUPAMENTO,
            'numeroItem' => $contrato->NUMERO_ITEM,
            'valorAvaliacao' => number_format($contrato->VALOR_AVALIACAO, 2, ',', '.'),
            'valorPrimeiroLeilao' => number_format($contrato->VALOR_PRIMEIRO_LEILAO, 2, ',', '.'),
            'valorSegundoLeilao' => number_format($contrato->VALOR_SEGUNDO_LEILAO, 2, ',', '.'),
            'valorVenda' => number_format($contrato->VALOR_VENDA, 2, ',', '.'),
            'valorContabil' => number_format($contrato->VALOR_CONTABIL, 2, ',', '.'),
            'dataConsolidacao' => $contrato->DATA_CONSOLIDACAO,
            'dataArremate' => $contrato->DATA_ARREMATE,

            'utilizacaoFgts' => $contrato->UTILIZACAO_FGTS,
            'dataImpedimento' => $contrato->DATA_IMPEDIMENTO_ATE,
            'estadoOcupacao' => $contrato->ESTADO_OCUPACAO,
            'iptu' => $contrato->IPTU,
            'matriculaImovel' => $contrato->MATRICULA,
            'origemMatricula' => $contrato->ORIGEM_MATRICULA,
            'origemImovel' => $contrato->ORIGEM_IMOVEL,
            'oficioMatriculaImovel' => $contrato->OFICIO,
            'garantia' => $contrato->GARANTIA,
            'statusImovel' => $contrato->STATUS_IMOVEL,
            'dataAlteracaoStatusImovel' => $contrato->DATA_ALTERACAO_STATUS,
            'dataUltimaAlteracaoStatus' => $contrato->DATA_ULTIMA_ALTERACAO,

            
            'tipoVenda' => $contrato->TIPO_VENDA,
            'dataProposta' => $contrato->DATA_PROPOSTA,
            'valorTotalProposta' => number_format($contrato->VALOR_TOTAL_PROPOSTA, 2, ',', '.'),
            'valorRecursosPropriosProposta' => number_format($contrato->VALOR_REC_PROPRIOS_PROPOSTA, 2, ',', '.'),
            'valorFgtsProposta' => number_format($contrato->VALOR_FGTS_PROPOSTA, 2, ',', '.'),
            'valorFinanciamentoProposta' => number_format($contrato->VALOR_FINANCIADO_PROPOSTA, 2, ',', '.'),
            'valorParceladoProposta' => number_format($contrato->VALOR_PARCELADO_PROPOSTA, 2, ',', '.'),
            'quantidadeParcelasProposta' => $contrato->QTDE_PARCELAS_PROPOSTA,
            'fluxoAgenciaOuCca' => $fluxoAgenciaOuCca,

            'nomeProponente' => $contrato->NOME_PROPONENTE,
            'cpfCnpjProponente' => $contrato->CPF_CNPJ_PROPONENTE,
            'enderecoProponente' => $contrato->ENDERECO_PROPONENTE,
            'cidadeProponente' => $contrato->CIDADE_PROPONENTE,
            'ufProponente' => $contrato->UF_PROPONENTE,
            'cepProponente' => $contrato->CEP_PROPONENTE,
            'motivoDesclassificacaoProposta' => $contrato->MOTIVO_DESCLASSIFICACAO_PROPOSTA,
            'agContratacaoProposta' => $contrato->AGENCIA_CONTRATACAO_PROPOSTA,
            'dddProponente' => $contrato->DDD_PROPONENTE,
            'telefoneProponente' => $contrato->TELEFONE_PROPONENTE,
            'modalidadePagamento' => $contrato->MODALIDADE_PAGAMENTO,
            'statusContrato' => $contrato->STATUS_CONTRATO,
            'dataContrato' => $contrato->DATA_CONTRATO,
            'statusProposta' => $contrato->STATUS_PROPOSTA,
        ];

        return json_encode($dadosContrato);
    }
}
