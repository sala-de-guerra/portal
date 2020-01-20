<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaseSimov;
use App\Models\RelacaoAgSrComEmail;

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
     * @param string  $numeroContrato
     * @return \Illuminate\Http\Response
     */
    static public function capturaDadosBaseSimov($numeroContrato)
    {
        // dd($numeroContrato);
        $contrato = BaseSimov::where('BEM_FORMATADO', $numeroContrato)->first();
        // dd($contrato);
        $dadosAgencia = RelacaoAgSrComEmail::where('nomeAgencia', $contrato->AGENCIA_CONTRATACAO_PROPOSTA)->first();
        
        // VALIDA FLUXO CONTRATAÇÃO DA PROPOSTA - CCA OU AGÊNCIA
        $fluxoAgenciaOuCca = self::validaFluxoContratacaoPropostaCcaAgencia($contrato);

        // VALIDA TELEFONE CORRETOR
        $telefoneCorretor = self::validaTelefoneCorretor($contrato);

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
        
        // MONTA O JSON QUE VAI PRA VIEW
        $dadosContrato = [
            'bemFormatado' => $numeroContrato,

            // DADOS DO IMÓVEL
            'numeroBem' => $contrato->NU_BEM,
            'classificacao' => $contrato->CLASSIFICACAO,
            'cep' => $contrato->CEP,
            'nomeEmpreendimento' => $contrato->NOME_EMPREENDIMENTO,
            'enderecoImovel' => $contrato->ENDERECO_IMOVEL,
            'bairroImovel' => $contrato->BAIRRO,
            'ufImovel' => $contrato->UF,
            'cidadeImovel' => $contrato->CIDADE,
            'tipoImovel' => $contrato->TIPO_IMOVEL,
            'statusImovel' => $contrato->STATUS_IMOVEL,
            'descricaoImovel' => $contrato->DESCRICAO_IMOVEL,
            'descricaoAdicionalImovel' => $contrato->DESCRICAO_ADIC_IMOVEL,
            'valorAvaliacao' => number_format($contrato->VALOR_AVALIACAO, 2, ',', '.'),
            'matriculaImovel' => $contrato->MATRICULA . " / " . $contrato->OFICIO . " Cartório",
            'origemMatricula' => $contrato->ORIGEM_MATRICULA,

            // LEILÕES
            'valorPrimeiroLeilao' => number_format($contrato->VALOR_PRIMEIRO_LEILAO, 2, ',', '.'),
            'valorSegundoLeilao' => number_format($contrato->VALOR_SEGUNDO_LEILAO, 2, ',', '.'),
            'valorVenda' => number_format($contrato->VALOR_VENDA, 2, ',', '.'),
            'valorContabil' => number_format($contrato->VALOR_CONTABIL, 2, ',', '.'),
            'dataConsolidacao' => $contrato->DATA_CONSOLIDACAO,
            'agrupamentoLeilao' => $contrato->AGRUPAMENTO,
            'numeroItem' => $contrato->NUMERO_ITEM,
            'dataArremate' => $contrato->DATA_ARREMATE,
            'dataPrimeiroLeilao' => $contrato->DT_PRIMEIRO_LEILAO,
            'dataSegundoLeilao' => $contrato->DT_SEGUNDO_LEILAO,

            // CONTRATAÇÃO
            'tipoVenda' => $contrato->TIPO_VENDA,
            'nomeProponente' => $contrato->NOME_PROPONENTE,
            'cpfCnpjProponente' => $contrato->CPF_CNPJ_PROPONENTE,
            'telefoneProponente' => '(' . $contrato->DDD_PROPONENTE . ') ' . $contrato->TELEFONE_PROPONENTE,
            // 'emailProponente' => ,
            'nomeCorretor' => $contrato->NO_CORRETOR,
            'numeroCreciCorretor' => $contrato->NU_CRECI,
            'telefoneCorretor' => $telefoneCorretor,
            'emailCorretor' => $contrato->EMAIL_CORRETOR,
            'dataProposta' => $contrato->DATA_PROPOSTA,
            'valorTotalProposta' => number_format($contrato->VALOR_TOTAL_PROPOSTA, 2, ',', '.'),
            'valorRecursosPropriosProposta' => number_format($contrato->VALOR_REC_PROPRIOS_PROPOSTA, 2, ',', '.'),
            'valorFgtsProposta' => number_format($contrato->VALOR_FGTS_PROPOSTA, 2, ',', '.'),
            'valorFinanciamentoProposta' => number_format($contrato->VALOR_FINANCIADO_PROPOSTA, 2, ',', '.'),
            'valorParceladoProposta' => number_format($contrato->VALOR_PARCELADO_PROPOSTA, 2, ',', '.'),
            'quantidadeParcelasProposta' => $contrato->QTDE_PARCELAS_PROPOSTA,
            'codigoAgContratacaoProposta' => str_pad($codigoAgenciaContratacao, 4, '0', STR_PAD_LEFT),
            'nomeAgContratacaoProposta' => $nomeAgenciaContratacao,
            'emailAgContratacaoProposta' => $emailAgenciaContratacao,
            // 'tipoContratacao'
            // 'cardAgrupamento'
            // 'statusDossie'
            'tipoFluxoContratacao' => $fluxoAgenciaOuCca,

            // CAMPOS SEM USO HOJE
            // 'dataEntrada' => $contrato->DATA_ENTRADA,
            // 'utilizacaoFgts' => $contrato->UTILIZACAO_FGTS,
            // 'dataImpedimento' => $contrato->DATA_IMPEDIMENTO_ATE,
            // 'estadoOcupacao' => $contrato->ESTADO_OCUPACAO,
            // 'iptu' => $contrato->IPTU,
            // 'origemImovel' => $contrato->ORIGEM_IMOVEL,
            // 'garantia' => $contrato->GARANTIA,
            // 'dataAlteracaoStatusImovel' => $contrato->DATA_ALTERACAO_STATUS,
            // 'dataUltimaAlteracaoStatus' => $contrato->DATA_ULTIMA_ALTERACAO,
            // 'enderecoProponente' => $contrato->ENDERECO_PROPONENTE,
            // 'cidadeProponente' => $contrato->CIDADE_PROPONENTE,
            // 'ufProponente' => $contrato->UF_PROPONENTE,
            // 'cepProponente' => $contrato->CEP_PROPONENTE,
            // 'motivoDesclassificacaoProposta' => $contrato->MOTIVO_DESCLASSIFICACAO_PROPOSTA,
            // 'modalidadePagamento' => $contrato->MODALIDADE_PAGAMENTO,
            // 'statusContrato' => $contrato->STATUS_CONTRATO,
            // 'dataContrato' => $contrato->DATA_CONTRATO,
            // 'statusProposta' => $contrato->STATUS_PROPOSTA,
        ];
        return json_encode($dadosContrato);
    }

    // public static function consultaApiRetaguardaPontoCaixa()
    // {
    //     $content = file_get_contents("http://sistemas1.retaguarda.caixa/relatorios/executar?arquivo=SICT2_imoveis_caixa_contratacao_dossie_campos.sql&movimento=%2220200102%2000:00%22");
    //     $result = json_decode($content);
    //     echo ($content);
    // } 

    public static function validatelefoneCorretor($contrato)
    {
        if ($contrato->TEL_COM_CORRETOR == null || $contrato->TEL_COM_CORRETOR == 'NULL') {
            if ($contrato->TEL_CEL_CORRETOR == null || $contrato->TEL_CEL_CORRETOR == 'NULL') {
                $telefoneCorretor = 'sem telefone cadastrado';
            } else {
                $telefoneCorretor = '(' . $contrato->DDD_CEL_CORRETOR . ') ' . $contrato->TEL_CEL_CORRETOR;
            }
        } else {
            if ($contrato->TEL_CEL_CORRETOR == null || $contrato->TEL_CEL_CORRETOR == 'NULL') {
                $telefoneCorretor = '(' . $contrato->DDD_COMERCIAL_CORRETOR . ') ' . $contrato->TEL_COM_CORRETOR;
            } else {
                $telefoneCorretor = '(' . $contrato->DDD_COMERCIAL_CORRETOR . ') ' . $contrato->TEL_COM_CORRETOR . '/ (' . $contrato->DDD_CEL_CORRETOR . ') ' . $contrato->TEL_CEL_CORRETOR;
            }
        }
        return $telefoneCorretor;
    }

    public static function validaFluxoContratacaoPropostaCcaAgencia($contrato)
    {
        if (is_null($contrato->ACEITA_CCA) || $contrato->ACEITA_CCA == 'Nao' || $contrato->ACEITA_CCA == 'NULL') {
            $fluxoAgenciaOuCca = 'AGÊNCIA';
        } else {
            $fluxoAgenciaOuCca = 'CCA';
        }

        return $fluxoAgenciaOuCca;
    }
}
