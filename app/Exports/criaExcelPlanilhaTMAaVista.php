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


class criaExcelPlanilhaTMAaVista implements FromCollection, WithHeadings, ShouldAutoSize
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
        $universoAVista= DB::table('TBL_VENDA_AVISTA')
            ->join('TBL_PAGAMENTOS_BOLETOS_CUB01', DB::raw('CONVERT(VARCHAR, TBL_PAGAMENTOS_BOLETOS_CUB01.NUMERO_BEM)'), '=', DB::raw('CONVERT(VARCHAR, TBL_VENDA_AVISTA.NU_BEM)'))
            ->select(DB::raw("
                TBL_VENDA_AVISTA.[BEM_FORMATADO] as BEM_FORMATADO,
                TBL_VENDA_AVISTA.[DIAS_DECORRIDOS] as DIAS_DECORRIDOS,
                TBL_VENDA_AVISTA.[CLASSIFICACAO] as CLASSIFICACAO,
                TBL_VENDA_AVISTA.[TIPO_VENDA] as tipoVenda,
                TBL_VENDA_AVISTA.[NOME_PROPONENTE] as NOME_PROPONENTE,
                TBL_VENDA_AVISTA.[CPF_CNPJ_PROPONENTE] as CPF_CNPJ_PROPONENTE,
                TBL_VENDA_AVISTA.[PAGAMENTO_BOLETO] as cancelamento        
    
            "))
             ->where('TBL_VENDA_AVISTA.UNA', '=', $siglaGilie)
             ->get();
    
            return $universoAVista;
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
            'Cancelamento'
            ],
        ];
    }
}