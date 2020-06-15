<?php

namespace App\Exports;

use App\Models\TabelaImportExcel;
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


class criaExcelPlanilhadeControle implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $criaPlanilha = TabelaImportExcel::query()
        ->select('Contrato',
        'Caixa',
        'Silog',
        'Matricula',
        'GILIE',
        'created_at')
        ->get();

        return $criaPlanilha;
     }

    public function headings(): array
    {

        return [
            ['Contrato',
            'Caixa',
            'Silog',
            'Responsável',
            'GILIE',
            'Data Upload'

            ],
        ];
    }
}