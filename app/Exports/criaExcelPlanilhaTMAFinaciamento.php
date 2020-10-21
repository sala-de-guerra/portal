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
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
        $universoFinanciamento= DB::table('TBL_VENDA_FINANCIADO')
            ->join('TBL_PAGAMENTOS_BOLETOS_CUB01', DB::raw('CONVERT(VARCHAR, TBL_PAGAMENTOS_BOLETOS_CUB01.NUMERO_BEM)'), '=', DB::raw('CONVERT(VARCHAR, TBL_VENDA_FINANCIADO.NU_BEM)'))
            ->select(DB::raw("
                TBL_VENDA_FINANCIADO.[BEM_FORMATADO] as BEM_FORMATADO,
                FORMAT(CONVERT(DECIMAL(10,2), REPLACE(TBL_PAGAMENTOS_BOLETOS_CUB01.[VALOR_TOTAL_BOLETO_PAGO], ',', '.')), 'N', 'pt-BR') AS PAGAMENTO_BOLETO,
                TBL_VENDA_FINANCIADO.[DIAS_DECORRIDOS] as DIAS_DECORRIDOS,
                TBL_VENDA_FINANCIADO.[CLASSIFICACAO] as CLASSIFICACAO,
                TBL_VENDA_FINANCIADO.[TIPO_VENDA] as tipoVenda,
                TBL_VENDA_FINANCIADO.[NOME_PROPONENTE] as NOME_PROPONENTE,
                TBL_VENDA_FINANCIADO.[CPF_CNPJ_PROPONENTE] as CPF_CNPJ_PROPONENTE,
                TBL_VENDA_FINANCIADO.[PAGAMENTO_BOLETO] as cancelamento        
    
            "))
             ->where('TBL_VENDA_FINANCIADO.UNA', '=', $siglaGilie)
             ->get();
    
            return $universoFinanciamento;
    }

    public function headings(): array
    {

        return [
            ['BEM',
            'Pagamento',
            'Dias Decorridos',
            'Classificação',
            'Tipo Venda',
            'Proponente',
            'CPF/CNPJ',
            "Cancelamento"
            ],
        ];
    }
}








