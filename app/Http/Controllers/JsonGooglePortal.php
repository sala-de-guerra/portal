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
        // $relacaoGilies = [
        //     'GILIE/BH', 'GILIE/BU', 'GILIE/BE', 'GILIE/BR', 'GILIE/CT', 'GILIE/FO', 'GILIE/GO', 'GILIE/PO', 'GILIE/RJ', 'GILIE/RE', 'GILIE/SA', 'GILIE/SP'
        // ];        
        // $arrayJsonBaseSimovPorGilie = [];
        // foreach ($relacaoGilies as $gilie) {
        //     $relacaoContratosBaseSimov = [$gilie => DB::select("
        //     SELECT
        //         'bemFormatado' = [BEM_FORMATADO]
        //         ,'numeroBem' = [NU_BEM]
        //         ,'enderecoCompleto' = CONCAT([ENDERECO_IMOVEL], ' - ', [BAIRRO], ' - ', [CIDADE])
        //         ,'nomeExMutuario' = [NO_EX_MUTUARIO]
        //         ,'cpfCnpjExMutuatio' = [NU_DOC_EX_MUTUARIO]
        //         ,'nomeProponente' = [NOME_PROPONENTE]
        //         ,'cpfCnpjProponente' = [CPF_CNPJ_PROPONENTE]
        //     FROM [ALITB001_Imovel_Completo]
        //     WHERE
        //         [UNA] = '" . $gilie . "'
        //     ")];
        //     array_push($arrayJsonBaseSimovPorGilie, $relacaoContratosBaseSimov);
        // }
        // if (file_exists('../public/js/baseSimov.json')) {
        //     unlink('../public/js/baseSimov.json');
        // }
        // $arquivoJson = fopen('../public/js/baseSimov.json', 'w');
        // fwrite($arquivoJson, json_encode(array('gilies' => $arrayJsonBaseSimovPorGilie)));
        // fclose($arquivoJson);
        
        $relacaoContratosBaseSimov = DB::select("
            SELECT
                'bemFormatado' = [BEM_FORMATADO]
                ,'numeroBem' = [NU_BEM]
                ,'enderecoCompleto' = CONCAT([ENDERECO_IMOVEL], ' - ', [BAIRRO], ' - ', [CIDADE])
                ,'nomeExMutuario' = [NO_EX_MUTUARIO]
                ,'cpfCnpjExMutuatio' = [NU_DOC_EX_MUTUARIO]
                ,'nomeProponente' = [NOME_PROPONENTE]
                ,'cpfCnpjProponente' = [CPF_CNPJ_PROPONENTE]
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