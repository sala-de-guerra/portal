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
        // if (!preg_match("/([0-9]{2})([.]{1})([0-9]{4})([.]{1})([0-9]{7})([-]{1})([0-9]{1})/", $numeroContrato) || $numeroContrato == '00.0000.0000000-0') {
        //     // RETORNA A FLASH MESSAGE
        //     $request->session()->flash('corMensagem', 'danger');
        //     $request->session()->flash('tituloMensagem', "Busca não efetuada");
        //     $request->session()->flash('corpoMensagem', "O termo digitado não retornou nenhum resultado. Tente novamente");

        //     return view('portal.imoveis.pesquisar');
        // } else {
            return view('portal.imoveis.consulta-bem-imovel')->with('numeroContrato', $numeroContrato);
        // }
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
        $contrato = BaseSimov::where('BEM_FORMATADO', $numeroContrato)->get();
        if (is_null($contrato[0]->ACEITA_CCA) || $contrato[0]->ACEITA_CCA == 'Nao' || $contrato[0]->ACEITA_CCA == 'NULL') {
            $fluxoAgenciaOuCca = 'AGÊNCIA';
        } else {
            $fluxoAgenciaOuCca = 'CCA';
        }
        

        $dadosContrato = [
            'bemFormatado' => $numeroContrato,
            'numeroBem' => $contrato[0]->NU_BEM,
            'classificacao' => $contrato[0]->CLASSIFICACAO,
            'dataEntrada' => $contrato[0]->DATA_ENTRADA,
            'cep' => $contrato[0]->CEP,
            'ufImovel' => $contrato[0]->UF,
            'cidadeImovel' => $contrato[0]->CIDADE,
            'nomeEmpreendimento' => $contrato[0]->NOME_EMPREENDIMENTO,
            'bairroImovel' => $contrato[0]->BAIRRO,
            'enderecoImovel' => $contrato[0]->ENDERECO_IMOVEL,
            'tipoImovel' => $contrato[0]->TIPO_IMOVEL,
            'descricaoImovel' => $contrato[0]->DESCRICAO_IMOVEL,
            'descricaoAdicionalImovel' => $contrato[0]->DESCRICAO_ADIC_IMOVEL,


            'agrupamentoLeilao' => $contrato[0]->AGRUPAMENTO,
            'numeroItem' => $contrato[0]->NUMERO_ITEM,
            'valorAvaliacao' => number_format($contrato[0]->VALOR_AVALIACAO, 2, ',', '.'),
            'valorPrimeiroLeilao' => number_format($contrato[0]->VALOR_PRIMEIRO_LEILAO, 2, ',', '.'),
            'valorSegundoLeilao' => number_format($contrato[0]->VALOR_SEGUNDO_LEILAO, 2, ',', '.'),
            'valorVenda' => number_format($contrato[0]->VALOR_VENDA, 2, ',', '.'),
            'valorContabil' => number_format($contrato[0]->VALOR_CONTABIL, 2, ',', '.'),
            'dataConsolidacao' => $contrato[0]->DATA_CONSOLIDACAO,
            'dataArremate' => $contrato[0]->DATA_ARREMATE,

            'utilizacaoFgts' => $contrato[0]->UTILIZACAO_FGTS,
            'dataImpedimento' => $contrato[0]->DATA_IMPEDIMENTO_ATE,
            'estadoOcupacao' => $contrato[0]->ESTADO_OCUPACAO,
            'iptu' => $contrato[0]->IPTU,
            'matriculaImovel' => $contrato[0]->MATRICULA,
            'origemMatricula' => $contrato[0]->ORIGEM_MATRICULA,
            'origemImovel' => $contrato[0]->ORIGEM_IMOVEL,
            'oficioMatriculaImovel' => $contrato[0]->OFICIO,
            'garantia' => $contrato[0]->GARANTIA,
            'statusImovel' => $contrato[0]->STATUS_IMOVEL,
            'dataAlteracaoStatusImovel' => $contrato[0]->DATA_ALTERACAO_STATUS,
            'dataUltimaAlteracaoStatus' => $contrato[0]->DATA_ULTIMA_ALTERACAO,

            
            'tipoVenda' => $contrato[0]->TIPO_VENDA,
            'dataProposta' => $contrato[0]->DATA_PROPOSTA,
            'valorTotalProposta' => number_format($contrato[0]->VALOR_TOTAL_PROPOSTA, 2, ',', '.'),
            'valorRecursosPropriosProposta' => number_format($contrato[0]->VALOR_REC_PROPRIOS_PROPOSTA, 2, ',', '.'),
            'valorFgtsProposta' => number_format($contrato[0]->VALOR_FGTS_PROPOSTA, 2, ',', '.'),
            'valorFinanciamentoProposta' => number_format($contrato[0]->VALOR_FINANCIADO_PROPOSTA, 2, ',', '.'),
            'valorParceladoProposta' => number_format($contrato[0]->VALOR_PARCELADO_PROPOSTA, 2, ',', '.'),
            'quantidadeParcelasProposta' => $contrato[0]->QTDE_PARCELAS_PROPOSTA,
            'tipoFluxoContratacao' => $fluxoAgenciaOuCca,

            'nomeProponente' => $contrato[0]->NOME_PROPONENTE,
            'cpfCnpjProponente' => $contrato[0]->CPF_CNPJ_PROPONENTE,
            'enderecoProponente' => $contrato[0]->ENDERECO_PROPONENTE,
            'cidadeProponente' => $contrato[0]->CIDADE_PROPONENTE,
            'ufProponente' => $contrato[0]->UF_PROPONENTE,
            'cepProponente' => $contrato[0]->CEP_PROPONENTE,
            'motivoDesclassificacaoProposta' => $contrato[0]->MOTIVO_DESCLASSIFICACAO_PROPOSTA,
            'agContratacaoProposta' => $contrato[0]->AGENCIA_CONTRATACAO_PROPOSTA,
            'dddProponente' => $contrato[0]->DDD_PROPONENTE,
            'telefoneProponente' => $contrato[0]->TELEFONE_PROPONENTE,
            'modalidadePagamento' => $contrato[0]->MODALIDADE_PAGAMENTO,
            'statusContrato' => $contrato[0]->STATUS_CONTRATO,
            'dataContrato' => $contrato[0]->DATA_CONTRATO,
            'statusProposta' => $contrato[0]->STATUS_PROPOSTA,
        ];

        return json_encode($dadosContrato);
    }

    // public static function consultaApiRetaguardaPontoCaixa()
    // {
    //     $content = file_get_contents("http://sistemas1.retaguarda.caixa/relatorios/executar?arquivo=SICT2_imoveis_caixa_contratacao_dossie_campos.sql&movimento=%2220200102%2000:00%22");
    //     $result = json_decode($content);
    //     echo ($content);
    // } 
}
