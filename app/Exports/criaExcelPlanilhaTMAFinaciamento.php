<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Classes\Ldap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;


class criaExcelPlanilhaTMAFinaciamento implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()

    public function collection()
    {
        // FORMAT(CONVERT(DECIMAL(10,2), REPLACE(TBL_PAGAMENTOS_BOLETOS_CUB01.[VALOR_TOTAL_BOLETO_PAGO], ',', '.')), 'N', 'pt-BR') AS PAGAMENTO_BOLETO,
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
        $universoFinanciamento= DB::table('TBL_VENDA_FINANCIADO')
            ->join('TBL_PAGAMENTOS_BOLETOS_CUB01', DB::raw('CONVERT(VARCHAR, TBL_PAGAMENTOS_BOLETOS_CUB01.NUMERO_BEM)'), '=', DB::raw('CONVERT(VARCHAR, TBL_VENDA_FINANCIADO.NU_BEM)'))
            ->join('ALITB001_Imovel_Completo', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_BEM)'), '=', DB::raw('CONVERT(VARCHAR, TBL_VENDA_FINANCIADO.NU_BEM)'))
            ->select(DB::raw("
                TBL_VENDA_FINANCIADO.[BEM_FORMATADO] as BEM_FORMATADO,
                TBL_VENDA_FINANCIADO.[DIAS_DECORRIDOS] as DIAS_DECORRIDOS,
                TBL_VENDA_FINANCIADO.[CLASSIFICACAO] as CLASSIFICACAO,
                TBL_VENDA_FINANCIADO.[TIPO_VENDA] as tipoVenda,
                TBL_VENDA_FINANCIADO.[NOME_PROPONENTE] as NOME_PROPONENTE,
                TBL_VENDA_FINANCIADO.[CPF_CNPJ_PROPONENTE] as CPF_CNPJ_PROPONENTE,
                TBL_VENDA_FINANCIADO.[PAGAMENTO_BOLETO] as cancelamento,
                TBL_VENDA_FINANCIADO.[ACEITA_CCA] as ACEITA_CCA,
                FORMAT(CONVERT(DECIMAL(10,2), REPLACE(ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA], ',', '.')), 'N', 'pt-BR') AS totalProposta, 
                FORMAT(CONVERT(DECIMAL(10,2), REPLACE(ALITB001_Imovel_Completo.[VALOR_REC_PROPRIOS_PROPOSTA], ',', '.')), 'N', 'pt-BR') AS valorRecursosProprios,
                FORMAT(CONVERT(DECIMAL(10,2), REPLACE(ALITB001_Imovel_Completo.[VALOR_FINANCIADO_PROPOSTA], ',', '.')), 'N', 'pt-BR') AS valorFinanciamento,            
                CONVERT(VARCHAR, ALITB001_Imovel_Completo.[DATA_LAUDO], 103) as dataLaudo,
                CONVERT(VARCHAR, ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO], 103) as vencimentoLaudo        
    
            "))
             ->where('TBL_VENDA_FINANCIADO.UNA', '=', $siglaGilie)
             ->get();
    
            return $universoFinanciamento;
    }

    public function headings(): array
    {

        return [
            ['BEM',
            'Dias Decorridos',
            'Classificação',
            'Tipo Venda',
            'Proponente',
            'CPF/CNPJ',
            "Cancelamento",
            "CCA",
            'Total Proposta',
            'Recursos Próprios',
            'Valor Financiamento',
            'Data Laudo',
            'Vencimento Laudo'
            ],
        ];
    }
}








