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


class criaExcelCorretoresCredenciamento implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      
        $Planilhacorretores= DB::table('TBL_CORRETORES_CADASTRAMENTO')
        ->select(DB::raw("
        [idProcesso] as processo
        ,[credenciado]
        ,[CNPJ]
        ,[CPF]
        ,[Representante]
        ,[numeroContrato]
        ,[dataConvoc]
        ,[contratoDevolvido]
        ,[endereço]
        ,[email]
        ,[obs]
        ,[SICAF]
      "))
        ->get();

        return $Planilhacorretores;
        
    }

    public function headings(): array
    {
        return [
            [
            'Processo' 
            ,'credenciado'
            ,'CNPJ'
            ,'CPF'
            ,'Representante'
            ,'Nº Contrato'
            ,'Data Convoc'
            ,'Contrato Devolvido'
            ,'Endereço'
            ,'e mail'
            ,'Obs'
            ,'SICAF'
            ],
        ];
    }
}