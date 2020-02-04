<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaseSimov;
use App\Models\ControleMensageria;
use App\Models\HistoricoPortalGilie;
use App\Models\PropostasSimov;
use App\Models\RelacaoAgSrComEmail;
use App\Models\GestaoImoveisCaixa\ConformidadeContratacao;
use Illuminate\Support\Carbon;


class ConsultaContratoController extends Controller
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
        // CAPTURA OS DADOS SIMOV DO CONTRATO
        $contrato = BaseSimov::where('BEM_FORMATADO', $numeroContrato)->first();
        // RETORNA JSON VAZIO NO CASO DO CONTRATO NÃO ESTAR NA BASE DE DADOS
        if ($contrato == null || $contrato == 'NULL') {
            $dadosContrato = [];
            return json_encode($dadosContrato);
        }
        
        // CAPTURA DADOS DE CONFORMIDADE
        $dadosConformidade = ConformidadeContratacao::where('numeroContrato', $contrato->NU_BEM)->first();
        // CAPTURA OS DADOS DA PROPOSTA DO PROPONENTE ATUAL
        $dadosProposta = PropostasSimov::where('NU_BEM', $contrato->NU_BEM)->where('VALOR RECURSOS PRÓPRIOS', $contrato->VALOR_REC_PROPRIOS_CONTRATO)->where('VALOR FGTS', $contrato->VALOR_FGTS_PROPOSTA)->where('VALOR FINANCIADO', $contrato->VALOR_FINANCIADO_PROPOSTA)->where('NOME PROPONENTE', $contrato->NOME_PROPONENTE)->first();

        // VALIDA FLUXO CONTRATAÇÃO DA PROPOSTA - CCA OU AGÊNCIA
        $fluxoAgenciaOuCca = self::validaFluxoContratacaoPropostaCcaAgencia($contrato);

        // VALIDA TELEFONE CORRETOR
        $telefoneCorretor = self::validaTelefoneCorretor($contrato);

        // VALIDA SE EXISTE AGÊNCIA DE CONTRATAÇÃO
        $dadosAgencia = RelacaoAgSrComEmail::where('nomeAgencia', $contrato->AGENCIA_CONTRATACAO_PROPOSTA)->first();
        if ($dadosAgencia == null || $dadosAgencia == 'NULL') {
            $codigoAgenciaContratacao = null;
            $nomeAgenciaContratacao = null;
            $emailAgenciaContratacao = null;
        } else {
            $codigoAgenciaContratacao = $dadosAgencia->codigoAgencia;
            $nomeAgenciaContratacao = $dadosAgencia->nomeAgencia;
            $emailAgenciaContratacao = $dadosAgencia->emailAgencia;
        }

        // VALIDA SE EXISTE CONFORMIDADE NO CONTRATO
        if ($dadosConformidade == null || $dadosConformidade == 'NULL') {
            $cardDeAgrupamento = null;
            $nomeStatusDoDossie =  null;
        } else {
            $cardDeAgrupamento = $dadosConformidade->cardDeAgrupamento;
            $nomeStatusDoDossie =  $dadosConformidade->nomeStatusDoDossie;
        }

        // VALIDA SE O PROPONENTE TEM E-MAIL CADASTRADO
        if ($dadosProposta ==  null || $dadosProposta == 'NULL') {
            $emailProponente = 'sem e-mail cadastrado';
        } else {
            $emailProponente = $dadosProposta->{'E-MAIL PROPONENTE'};
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
            'valorAvaliacao' => $contrato->VALOR_AVALIACAO,
            'matriculaImovel' => $contrato->MATRICULA . " / " . $contrato->OFICIO . " Cartório",
            'origemMatricula' => $contrato->ORIGEM_MATRICULA,

            // LEILÕES
            'valorPrimeiroLeilao' => $contrato->VALOR_PRIMEIRO_LEILAO,
            'valorSegundoLeilao' => $contrato->VALOR_SEGUNDO_LEILAO,
            'valorVenda' => $contrato->VALOR_VENDA,
            'valorContabil' => $contrato->VALOR_CONTABIL,
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
            'telefoneProponente' => $contrato->TELEFONE_PROPONENTE == null ? 'sem telefone cadastrado' : '(' . $contrato->DDD_PROPONENTE . ') ' . $contrato->TELEFONE_PROPONENTE,
            'emailProponente' => $emailProponente == null ? 'sem e-mail cadastrado' : $emailProponente,
            'nomeCorretor' => $contrato->NO_CORRETOR,
            'numeroCreciCorretor' => $contrato->NU_CRECI,
            'telefoneCorretor' => $contrato->TELEFONE_PROPONENTE == null ? 'sem telefone cadastrado' : $telefoneCorretor,
            'emailCorretor' =>  $contrato->EMAIL_CORRETOR == null ? 'sem e-mail cadastrado' : $contrato->EMAIL_CORRETOR,
            'dataProposta' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
            'valorTotalProposta' => $contrato->VALOR_TOTAL_PROPOSTA,
            'valorRecursosPropriosProposta' => $contrato->VALOR_REC_PROPRIOS_PROPOSTA,
            'valorFgtsProposta' => $contrato->VALOR_FGTS_PROPOSTA,
            'valorFinanciamentoProposta' => $contrato->VALOR_FINANCIADO_PROPOSTA,
            'valorParceladoProposta' => $contrato->VALOR_PARCELADO_PROPOSTA,
            'quantidadeParcelasProposta' => $contrato->QTDE_PARCELAS_PROPOSTA,
            'codigoAgContratacaoProposta' => str_pad($codigoAgenciaContratacao, 4, '0', STR_PAD_LEFT),
            'nomeAgContratacaoProposta' => $nomeAgenciaContratacao,
            'emailAgContratacaoProposta' => $emailAgenciaContratacao,
            'siglaComissao' => $contrato->SIGLA_COMISSAO,
            'agrupamento' => $contrato->AGRUPAMENTO,
            // 'tipoContratacao'
            'cardAgrupamento' => $cardDeAgrupamento,
            'nomeStatusDossie' => $nomeStatusDoDossie,
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

    static public function consultaMensagensEnviadas($numeroContrato)
    {
        $universoMensagensEnviadas = ControleMensageria::where('numeroContrato', $numeroContrato)->get();
        $jsonMensagensEnviadas = [];
        foreach ($universoMensagensEnviadas as $mensagem) {
            $arrayDadosMensagem = [
                'idMensagem' => $mensagem->id,
                'tipoMensagem' => $mensagem->tipoMensagem,
                'codigoAgencia' => $mensagem->codigoAgencia == null ? '' : $mensagem->codigoAgencia,
                'emailProponente' => $mensagem->emailProponente == null ? '' : $mensagem->emailProponente,
                'emailCorretor' => $mensagem->emailCorretor == null ? '' : $mensagem->emailCorretor,
                'dataEnvio' => $mensagem->created_at,
            ];
            array_push($jsonMensagensEnviadas, $arrayDadosMensagem);
        }
        $jsonMensagensEnviadas = ['mensagens' => $jsonMensagensEnviadas];

        return json_encode($jsonMensagensEnviadas);
    }

    static public function consultaHistorico($numeroContrato)
    {
        $universoHistoricoContrato = HistoricoPortalGilie::where('numeroContrato', $numeroContrato)->get();
        $jsonHistoricoContrato = [];
        foreach ($universoHistoricoContrato as $historico) {
            $arrayDadosHistorico = [
                'idHistorico' => $historico->idHistorico,
                'matriculaResponsavel' => $historico->matricula,
                'tipo' => $historico->tipo,
                'atividade' => $historico->atividade,
                'observacao' => $historico->observacao,
                'data' => $historico->created_at,
            ];
            array_push($jsonHistoricoContrato, $arrayDadosHistorico);
        }
        $jsonHistoricoContrato = ['historico' => $jsonHistoricoContrato];
        
        return json_encode($jsonHistoricoContrato);
    }

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

    // public static function consultaApiRetaguardaPontoCaixa()
    // {
    //     $content = file_get_contents("http://sistemas1.retaguarda.caixa/relatorios/executar?arquivo=SICT2_imoveis_caixa_contratacao_dossie_campos.sql&movimento=%2220200102%2000:00%22");
    //     $result = json_decode($content);
    //     echo ($content);
    // } 
}
