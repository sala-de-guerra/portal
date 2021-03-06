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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;


class criaExcelCorretores implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      
        $date = date('Y-m-d');
        $Planilhacorretores= DB::table('TBL_CORRETORES')
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[DDD], 'Null') as DDD,
        nullif(TBL_CORRETORES.[TELEFONE], 'Null') as TELEFONE,
        nullif(TBL_CORRETORES.[CO_DDD_COMERCIAL], 'Null') as DDDCOMERCIAL,
        nullif(TBL_CORRETORES.[CO_TELEFONE_COMERCIAL], 'Null') as TELEFONECOMERCIAL,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->orderBy('TBL_CORRETORES.NO_CORRETOR', 'asc')
        ->get();

        return $Planilhacorretores;
        
    }

    public function headings(): array
    {
        return [
            [
            'CORRETOR', 
            'CRECI', 
            'DDD', 
            'TELEFONE', 
            'DDD COMERCIAL', 
            'TELEFONE COMERCIAL', 
            'DDD CELULAR', 
            'TELEFONE CELULAR', 
            'EMAIL', 
            'VENCIMENTO', 
            'GILIE' 
            ],
        ];
    }
}