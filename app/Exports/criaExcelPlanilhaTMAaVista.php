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
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
        $universoAVista= DB::table('TBL_VENDA_AVISTA')
            ->select(DB::raw("
                TBL_VENDA_AVISTA.[BEM_FORMATADO] as BEM_FORMATADO,
                FORMAT(CONVERT(DECIMAL(10,2), REPLACE(TBL_VENDA_AVISTA.[PAGAMENTO_BOLETO], ',', '.')), 'N', 'pt-BR') AS PAGAMENTO_BOLETO,
                TBL_VENDA_AVISTA.[DIAS_DECORRIDOS] as DIAS_DECORRIDOS,
                TBL_VENDA_AVISTA.[CLASSIFICACAO] as CLASSIFICACAO,
                TBL_VENDA_AVISTA.[STATUS_IMOVEL] as STATUS_IMOVEL,
                TBL_VENDA_AVISTA.[TIPO_VENDA] as tipoVenda,
                TBL_VENDA_AVISTA.[NOME_PROPONENTE] as NOME_PROPONENTE,
                TBL_VENDA_AVISTA.[CPF_CNPJ_PROPONENTE] as CPF_CNPJ_PROPONENTE         
    
            "))
             ->where('TBL_VENDA_AVISTA.UNA', '=', $siglaGilie)
             ->get();
    

            return $universoAVista;
    }

    public function headings(): array
    {

        return [
            ['BEM',
            'Pagamento',
            'Dias Decorridos',
            'Classificação',
            'Status',
            'Tipo Venda',
            'Proponente',
            'CPF/CNPJ'
            ],
        ];
    }
}








