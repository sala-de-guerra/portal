<?php 

namespace App\Http\Controllers\GestaoImoveisCaixa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
use App\Http\Controllers\Comex\Contratacao\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Classes\GestaoImoveisCaixa\ImoveisCaixaPhpMailer;
use App\RelacaoAgSrComEmail;

class RotinaMensagensAutomatica extends Controller
{
        
    public static function mensagemAutorizacaoImoveisPatrimoniais()
    {
       $relacaoContratos = DB::select('SELECT 
                                            "numeroBem" = [BEM_FORMATADO]
                                            ,"grupoClassificacao" = CASE 
                                                                        WHEN [CLASSIFICACAO] LIKE "%EMGEA%" THEN "EMGEA"
                                                                        WHEN [CLASSIFICACAO] = "PANAMERICANO" THEN "PATRIMONIAL"
                                                                        WHEN [CLASSIFICACAO] = "Patrimonial -Realização de Garantia" THEN "PATRIMONIAL"
                                                                        ELSE "CAIXA"
                                                                    END
                                            ,"tipoVenda" = CASE
                                                                WHEN [TIPO_VENDA] LIKE "Venda Online" THEN "VENDA ONLINE"
                                                                WHEN [TIPO_VENDA] LIKE "Venda Direta Online" THEN "VENDA ONLINE"
                                                                WHEN [TIPO_VENDA] LIKE "%Leilão%" THEN "LEILAO"
                                                                WHEN [TIPO_VENDA] LIKE "Venda Direta Online" THEN "VENDA ONLINE"
                                                                ELSE "OUTROS TIPOS"
                                                            END
                                            ,"tipoProposta" = CASE 
                                                                WHEN [VALOR_REC_PROPRIOS_PROPOSTA] = [VALOR_TOTAL_PROPOSTA] THEN "A VISTA"
                                                                ELSE "FINANCIADO"
                                                            END
                                            ,"acaoJudial" = CASE
                                                                WHEN [DESCRICAO_ADIC_IMOVEL] LIKE "%JUDICIA%" THEN "SIM"
                                                                WHEN [DESCRICAO_ADIC_IMOVEL] LIKE "%AÇÕES%" THEN "SIM"
                                                                WHEN [DESCRICAO_ADIC_IMOVEL] LIKE "% AÇÃO %" THEN "SIM"
                                                                WHEN [DESCRICAO_ADIC_IMOVEL] LIKE "% ACAO %" THEN "SIM"
                                                                WHEN [DESCRICAO_ADIC_IMOVEL] LIKE "%ACOES%" THEN "SIM"
                                                                ELSE "NAO"
                                                            END
                                            ,"nomeAgencia" = [UNO]
                                            ,"nomeSr" = [EN]
                                            ,"enderecoImovel" = [ENDERECO_IMOVEL]
                                            ,"dataAlteracaoStatus" = [DATA_ALTERACAO_STATUS]
                                            ,"nomeProponente" = UPPER([NOME_PROPONENTE])
                                            ,"cpfProponente" = [CPF_CNPJ_PROPONENTE]
                                            ,"nomeCorretor" = UPPER([NO_CORRETOR])
                                            ,"emailCorretor" = [EMAIL_CORRETOR]
                                        FROM 
                                            [7257_1].[dbo].[ALITB001_Imovel_Completo] AS SIMOV
                                        WHERE 
                                            [UNA] = "GILIE/SP"
                                            AND [STATUS_IMOVEL] = "Em contratação"
                                            AND ([TIPO_VENDA] LIKE "Venda Online" OR [TIPO_VENDA] like "Venda Direta Online" OR [TIPO_VENDA] LIKE "1º Leilão SFI" OR [TIPO_VENDA] LIKE "2º Leilão SFI")
                                            AND [DATA_ALTERACAO_STATUS] >=  DATEADD(DAY, -16, GETDATE())
                                            AND ([CLASSIFICACAO] = "PANAMERICANO" OR [CLASSIFICACAO] = "Patrimonial -Realização de Garantia")
                                        ORDER BY
                                            "grupoClassificacao"
                                            ,"tipoVenda"
                                            ,"tipoProposta"'); 
        return $relacaoContratos;
    }
}