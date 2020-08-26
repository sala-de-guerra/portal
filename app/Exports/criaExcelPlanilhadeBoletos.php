<?php

namespace App\Exports;

use App\Models\GestaoImoveisCaixa\ControleExcelBoleto;
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


class criaExcelPlanilhadeBoletos implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()

    public function collection()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $boletosAvista= DB::table('CUB_056_PAGAMENTOS_BOLETOS_SIMOV')
        ->select(DB::raw("
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[GILIE] as gilie,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[NU_BEM] as nuBEM,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PROPONENTE1] as proponente,
        FORMAT(CONVERT(DECIMAL(10,2), REPLACE(CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VALOR BOLETO], ',', '.')), 'N', 'pt-BR') AS valorBoleto,
        FORMAT(CONVERT(DECIMAL(10,2), REPLACE(CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGO], ',', '.')), 'N', 'pt-BR') AS valorPagamento,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[VENCIMENTO] as vencimento,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[SITUAÇÃO] as status,
        CUB_056_PAGAMENTOS_BOLETOS_SIMOV.[PAGAMENTO] as dataPagamento
      "))
        ->where('CUB_056_PAGAMENTOS_BOLETOS_SIMOV.GILIE', $codigoUnidadeUsuarioSessao)
        ->whereNotNull('PAGO')
        ->whereNotNull('SITUAÇÃO')
        ->get();
        return $boletosAvista;
    }

    public function headings(): array
    {

        return [
            ['GILIE',
            'Numero Bem',
            'Proponente',
            'Valor Boleto',
            'Valor Pagamento',
            'Vencimento',
            'Status',
            'Data Pagamento'
            ],
        ];
    }
}








