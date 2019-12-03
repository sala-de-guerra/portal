<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;

class JsonGooglePortal extends Controller
{
    public static function criaJsonParaAbastecerBarraPesquisaGoogle()
    {
        $relacaoContratosBaseSimov = DB::select("
            SELECT
                'bemFormatado' = [BEM_FORMATADO]
                ,'numeroBem' = [NU_BEM]
                ,'enderecoCompleto' = CONCAT([ENDERECO_IMOVEL], ' - ', [BAIRRO], ' - ', [CIDADE])
                ,'nomeExMutuario' = [NO_EX_MUTUARIO]
                ,'cpfCnpjExMutuatio' = [NU_DOC_EX_MUTUARIO]
                ,'nomeProponente' = [NOME_PROPONENTE]
                ,'cpfCnpjProponente' = [CPF_CNPJ_PROPONENTE]
                --,'documentoPrimeiroCoobrigado' = [NU_DOC_COOBRIGADO_1]
                --,'nomePrimeiroCoobrigado' = [NO_COOBRIGADO_1]
                --,'documentoSegundoCoobrigado' = [NU_DOC_COOBRIGADO_2]
                --,'nomeSegundoCoobrigado' = [NO_COOBRIGADO_2]
                --,'documentoTerceiroCoobrigado' = [NU_DOC_COOBRIGADO_3]
                --,'nomeTerceiroCoobrigado' = [NO_COOBRIGADO_3]
                --,'documentoQuartoCoobrigado' = [NU_DOC_COOBRIGADO_4]
                --,'nomeQuartoCoobrigado' = [NO_COOBRIGADO_4]
                --,'documentoQuintoCoobrigado' = [NU_DOC_COOBRIGADO_5]
                --,'nomeQuintoCoobrigado' = [NO_COOBRIGADO_5]
            FROM [ALITB001_Imovel_Completo]
            WHERE
                [UNA] = 'GILIE/SP'
            ");
        if (file_exists('../public/js/baseSimov.json')) {
            unlink('../public/js/baseSimov.json');
        }
        $arquivoJson = fopen('../public/js/baseSimov.json', 'w');
        fwrite($arquivoJson, json_encode(array('bens' => $relacaoContratosBaseSimov)));
        fclose($arquivoJson);
        return 'pronto!';
    }
}