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
use Illuminate\Support\Facades\DB;


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
        // dd($dadosConformidade);
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
            $dataParecerConformidade = null;
        } else {
            $cardDeAgrupamento = $dadosConformidade->cardDeAgrupamento;
            $nomeStatusDoDossie =  $dadosConformidade->nomeStatusDoDossie;
            $dataParecerConformidade = $dadosConformidade->dataStatus;
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
            'dataLaudoAvaliacao' => Carbon::parse($contrato->DATA_LAUDO)->format('Y-m-d'),
            'dataValidadeLaudoAvaliacao' => Carbon::parse($contrato->DATA_VENCIMENTO_LAUDO)->format('Y-m-d'),

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
            'nomeProponente' => strtoupper($contrato->NOME_PROPONENTE),
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
            'dataAssinaturaContrato' => $contrato->DATA_CONTRATO == null ? $contrato->DATA_CONTRATO : Carbon::parse($contrato->DATA_CONTRATO)->format('Y-m-d'),
            // 'tipoContratacao'
            'cardAgrupamento' => $cardDeAgrupamento,
            'nomeStatusDossie' => $nomeStatusDoDossie,
            'tipoFluxoContratacao' => $fluxoAgenciaOuCca,
            'dataParecerConformidade' => $dataParecerConformidade == null ? $dataParecerConformidade : Carbon::parse($dataParecerConformidade)->format('Y-m-d'),
            

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
                'observacao' => nl2br($historico->observacao),
                'data' => $historico->created_at,
            ];
            array_push($jsonHistoricoContrato, $arrayDadosHistorico);
        }
        $jsonHistoricoContrato = ['historico' => $jsonHistoricoContrato];
        
        return json_encode($jsonHistoricoContrato);
    }

    public static function validaTelefoneCorretor($contrato)
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function pesquisaContratoComWhereVariavel(Request $request)
    {
        $arrayParaEvitarContratosDuplicados = [];
        $arrayConsultaConsolidada = [];
        switch ($request->tipoVariavel) {
            case 'cpfCnpjProponente':
                $termoPesquisaTratado = self::trataVariavelCpfCnpj($request->valorVariavel);
                foreach ($termoPesquisaTratado as $termo) {
                    $resultadoConsulta = DB::table('ALITB001_Imovel_Completo')->select('BEM_FORMATADO','NU_BEM', 'ENDERECO_IMOVEL', 'UNA', 'CPF_CNPJ_PROPONENTE', 'NOME_PROPONENTE', 'TIPO_VENDA', 'NU_DOC_EX_MUTUARIO', 'NO_EX_MUTUARIO', 'MATRICULA', 'OFICIO')->where('CPF_CNPJ_PROPONENTE', 'like', "%$termo%")->get();
                    foreach ($resultadoConsulta as $cadaResultado) {
                        $arrayConsultaConsolidada = self::montaArrayResultado($arrayConsultaConsolidada, $cadaResultado);
                    }
                }
                break;
            case 'nomeProponente':
                $termoPesquisaTratado = self::trataVariavelNome($request->valorVariavel);
                foreach ($termoPesquisaTratado as $termo) {
                    $resultadoConsulta = DB::table('ALITB001_Imovel_Completo')->select('BEM_FORMATADO','NU_BEM', 'ENDERECO_IMOVEL', 'UNA', 'CPF_CNPJ_PROPONENTE', 'NOME_PROPONENTE', 'TIPO_VENDA', 'NU_DOC_EX_MUTUARIO', 'NO_EX_MUTUARIO', 'MATRICULA', 'OFICIO')->where('NOME_PROPONENTE', 'like', "%$termo[0]%")->get();
                    foreach ($resultadoConsulta as $cadaResultado) {
                        if (!in_array($cadaResultado->NU_BEM, $arrayParaEvitarContratosDuplicados)) {
                            $arrayConsultaConsolidada = self::montaArrayResultado($arrayConsultaConsolidada, $cadaResultado);
                            array_push($arrayParaEvitarContratosDuplicados, $cadaResultado->NU_BEM);
                        }
                    }
                }
                break;
            case 'numeroContrato':
                $termoPesquisaTratado = self::trataVariavelContrato($request->valorVariavel);
                $resultadoConsulta = DB::table('ALITB001_Imovel_Completo')->select('BEM_FORMATADO','NU_BEM', 'ENDERECO_IMOVEL', 'UNA', 'CPF_CNPJ_PROPONENTE', 'NOME_PROPONENTE', 'TIPO_VENDA', 'NU_DOC_EX_MUTUARIO', 'NO_EX_MUTUARIO', 'MATRICULA', 'OFICIO')->where('NU_BEM', 'like', "%$termoPesquisaTratado%")->get();
                foreach ($resultadoConsulta as $cadaResultado) {
                    $arrayConsultaConsolidada = self::montaArrayResultado($arrayConsultaConsolidada, $cadaResultado);
                }
                break;
            case 'enderecoImovel':
                $termoPesquisaTratado = self::trataVariavelEndereco($request->valorVariavel);
                $resultadoConsulta = DB::table('ALITB001_Imovel_Completo')->select('BEM_FORMATADO','NU_BEM', 'ENDERECO_IMOVEL', 'UNA', 'CPF_CNPJ_PROPONENTE', 'NOME_PROPONENTE', 'TIPO_VENDA', 'NU_DOC_EX_MUTUARIO', 'NO_EX_MUTUARIO', 'MATRICULA', 'OFICIO')->where('ENDERECO_IMOVEL', 'like', "%$termoPesquisaTratado%")->get();
                foreach ($resultadoConsulta as $cadaResultado) {
                    $arrayConsultaConsolidada = self::montaArrayResultado($arrayConsultaConsolidada, $cadaResultado);
                }
                break;
            case 'cpfCnpjExMutuario':
                $termoPesquisaTratado = self::trataVariavelCpfCnpj($request->valorVariavel);
                foreach ($termoPesquisaTratado as $termo) {
                    $resultadoConsulta = DB::table('ALITB001_Imovel_Completo')->select('BEM_FORMATADO','NU_BEM', 'ENDERECO_IMOVEL', 'UNA', 'CPF_CNPJ_PROPONENTE', 'NOME_PROPONENTE', 'TIPO_VENDA', 'NU_DOC_EX_MUTUARIO', 'NO_EX_MUTUARIO', 'MATRICULA', 'OFICIO')->where('NU_DOC_EX_MUTUARIO', 'like', "%$termo%")->get();
                    foreach ($resultadoConsulta as $cadaResultado) {
                        $arrayConsultaConsolidada = self::montaArrayResultado($arrayConsultaConsolidada, $cadaResultado);
                    }
                }
                break;
            case 'nomeExMutuario':
                $termoPesquisaTratado = self::trataVariavelNome($request->valorVariavel);
                foreach ($termoPesquisaTratado as $termo) {
                    $resultadoConsulta = DB::table('ALITB001_Imovel_Completo')->select('BEM_FORMATADO','NU_BEM', 'ENDERECO_IMOVEL', 'UNA', 'CPF_CNPJ_PROPONENTE', 'NOME_PROPONENTE', 'TIPO_VENDA', 'NU_DOC_EX_MUTUARIO', 'NO_EX_MUTUARIO', 'MATRICULA', 'OFICIO')->where('NO_EX_MUTUARIO', 'like', "%$termo[0]%")->get();
                    foreach ($resultadoConsulta as $cadaResultado) {
                        if (!in_array($cadaResultado->NU_BEM, $arrayParaEvitarContratosDuplicados)) {
                            $arrayConsultaConsolidada = self::montaArrayResultado($arrayConsultaConsolidada, $cadaResultado);
                            array_push($arrayParaEvitarContratosDuplicados, $cadaResultado->NU_BEM);
                        }
                    }
                }
                break;
            case 'matriculaImovel':
                // $termoPesquisaTratado = self::trataVariavelNome($request->valorVariavel);
                // foreach ($termoPesquisaTratado as $termo) {
                    $resultadoConsulta = DB::table('ALITB001_Imovel_Completo')->select('BEM_FORMATADO','NU_BEM', 'ENDERECO_IMOVEL', 'UNA', 'CPF_CNPJ_PROPONENTE', 'NOME_PROPONENTE', 'TIPO_VENDA', 'NU_DOC_EX_MUTUARIO', 'NO_EX_MUTUARIO', 'MATRICULA', 'OFICIO')->where('MATRICULA', 'like', "%$request->valorVariavel%")->get();
                    foreach ($resultadoConsulta as $cadaResultado) {
                        if (!in_array($cadaResultado->NU_BEM, $arrayParaEvitarContratosDuplicados)) {
                            $arrayConsultaConsolidada = self::montaArrayResultado($arrayConsultaConsolidada, $cadaResultado);
                            array_push($arrayParaEvitarContratosDuplicados, $cadaResultado->NU_BEM);
                        }
                    }
                // }
                break;
        }

        // SETTA UMA FLAG PARA DIZER SE EXISTE RESULTADO OU NÃO
        if (count($arrayConsultaConsolidada) > 0) {
            if (count($arrayConsultaConsolidada) == 1) {
                return redirect()->route('consulta-bem-imovel', $arrayConsultaConsolidada[0]['contratoFormatado']);
            } else {
                $request->session()->flash('pesquisaComResultados');
                return view('portal.imoveis.consultar.consultar-imovel')->with('resultadoPesquisa', $arrayConsultaConsolidada);
            }
        } else {
            $request->session()->flash('pesquisaSemResultados');
            return view('portal.imoveis.consultar.consultar-imovel')->with('resultadoPesquisa', 'Não foram encontratos resultados para a pesquisa. Tente novamente.');
        }
    }

    public static function trataVariavelNome($valorVariavel)
    {
        $arrayNomesTratados = [];
        $nomeCompletoComPorcentagem = str_replace(' ', '%', $valorVariavel);
        // PEGA O NOME COMPLETO E TROCA OS ESPAÇOS POR % PARA REALIZAR A PESQUISA NO BANCO DE DADOS
        array_push($arrayNomesTratados, [
            $nomeCompletoComPorcentagem
        ]);
        // PEGA O PRIMEIRO E ULTIMO NOME PARA REALIZAR A PESQUISA NO BANCO DE DADOS
        $valorTratado = explode(' ', $valorVariavel);
        if (count($valorTratado) > 1) {
            array_push($arrayNomesTratados, [
                $valorTratado = '%' . $valorTratado[0] . '%' . $valorTratado[count($valorTratado) - 1] . '%'
            ]);
        }
        return $arrayNomesTratados;
    }

    public static function trataVariavelContrato($valorVariavel)
    {
        // REMOVE AS PONTUAÇÕES ('.', '-') PARA REALIZAR A PESQUISA NO CASO DOS CONTRATOS FORMATADOS
        if (strpos($valorVariavel, '.') !== false || strpos($valorVariavel, '-') !== false) {
            $valorVariavel = str_replace('-', '', str_replace('.', '', $valorVariavel));
        }
        return (int) $valorVariavel;
    }

    public static function trataVariavelCpfCnpj($valorVariavel)
    {       
        $arrayTermosCpfCnpjAjustado = [];
        // VERIFICA SE É CNPJ E REMOVE AS STRINGS '.', '/', '-'
        if (strpos($valorVariavel, '/') !== false) {
            $valorCpfCnpjTratado = str_replace('-', '', str_replace('.', '', str_replace('/', '', $valorVariavel)));
            // SALVA NO ARRAY PARA PESQUISA
            array_push($arrayTermosCpfCnpjAjustado, (string) (int) $valorCpfCnpjTratado);
        // VERIFICA SE É CPF E REMOVE AS STRINGS '.', '-'
        } elseif(strpos($valorVariavel, '-') !== false && strpos($valorVariavel, '/') == false) {
            $valorCpfCnpjTratado = str_replace('.', '', str_replace('-', '', $valorVariavel));
            // SALVA NO ARRAY PARA PESQUISA
            array_push($arrayTermosCpfCnpjAjustado, (string) (int) $valorCpfCnpjTratado);
        // AQUI SÃO OS CASOS PESQUISADOS JÁ SEM FORMATAÇÃO
        } else {
            // SALVA NO ARRAY PARA PESQUISA
            $valorCpfCnpjTratado = $valorVariavel;
            array_push($arrayTermosCpfCnpjAjustado, (string) (int) $valorCpfCnpjTratado);
        }
        // AQUI MONTA O CPF/CPNJ COM BASE NO TAMANHO DA STRING        
        if(strlen($valorCpfCnpjTratado) <= 11) {
            $valorCpfCnpjTratado = str_pad($valorCpfCnpjTratado, 11, "0", STR_PAD_LEFT);
            array_push($arrayTermosCpfCnpjAjustado, substr($valorCpfCnpjTratado, -11, 3) . '.' . substr($valorCpfCnpjTratado, -8, 3) . '.' . substr($valorCpfCnpjTratado, -5, 3) . '-' . substr($valorCpfCnpjTratado, -2, 2));
        } else {
            $valorCpfCnpjTratado = str_pad($valorCpfCnpjTratado, 14, "0", STR_PAD_LEFT);
            array_push($arrayTermosCpfCnpjAjustado, substr($valorCpfCnpjTratado, -14, 2) . '.' . substr($valorCpfCnpjTratado, -12, 3) . '.' . substr($valorCpfCnpjTratado, -9, 3) . '/' . substr($valorCpfCnpjTratado, -6, 4) . '-' . substr($valorCpfCnpjTratado, -2, 2));
        }           
        return $arrayTermosCpfCnpjAjustado;
    }

    public static function trataVariavelEndereco($valorVariavel)
    {
        $arrayTermosParaDesconsiderarDoEndereco = [
            'Rua', 'R' , 'Av', 'Avenida', 'nº', 'n' , '-' , '(', ')', ',' , 'N.', 'do', 'de', 'dos', 'Av.', 'Apto', 'Bl', 'Bloco', 'Apartamento', 'Ap.'
        ];
        $enderecoTratado = '';
        $termoTratado = explode(' ', $valorVariavel);
        foreach ($termoTratado as $termo) {
            if (!in_array($termo, $arrayTermosParaDesconsiderarDoEndereco)) {
                $enderecoTratado .= '%' . $termo;
            }
        }       
        return $enderecoTratado;
    }

    public static function montaArrayResultado($arrayConsultaConsolidada, $objetoSimov)
    {
        array_push($arrayConsultaConsolidada, [
            'contratoFormatado' => $objetoSimov->BEM_FORMATADO,
            'numeroContrato' => $objetoSimov->NU_BEM,
            'enderecoImovel' => strtoupper($objetoSimov->ENDERECO_IMOVEL),
            'gilieResponsavel' => $objetoSimov->UNA,
            'cpfCnpjProponente' => $objetoSimov->CPF_CNPJ_PROPONENTE,
            'nomeProponente' => $objetoSimov->NOME_PROPONENTE == null ? 'NÃO EXISTE PROPONENTE' : mb_strtoupper($objetoSimov->NOME_PROPONENTE, 'UTF-8'),
            'tipoVenda' => mb_strtoupper($objetoSimov->TIPO_VENDA, 'UTF-8'),
            'cpfCnpjExMutuario' => $objetoSimov->NU_DOC_EX_MUTUARIO,
            'nomeExMutuario' => $objetoSimov->NO_EX_MUTUARIO == null ? 'NÃO EXISTE EX-MUTUÁRIO' : mb_strtoupper($objetoSimov->NO_EX_MUTUARIO, 'UTF-8'),
            'matriculaImovel' => $objetoSimov->MATRICULA . " / " . $objetoSimov->OFICIO . "º CARTÓRIO"
        ]);
        return $arrayConsultaConsolidada;
    }

    public static function consultaImovelComWhereVariavel()
    {
        return view('portal.imoveis.consultar.consultar-imovel');
    }
}
