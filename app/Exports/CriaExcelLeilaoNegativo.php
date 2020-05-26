<?php

namespace App\Exports;
use App\Models\LeilaoNegativo\LeilaoNegativo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Classes\Ldap;
use Illuminate\Support\Carbon;




class CriaExcelLeilaoNegativo implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $unidade = Ldap::defineUnidadeUsuarioSessao();
        $criaPlanilha = LeilaoNegativo::where('unidadeResponsavel', $unidade)
        ->select('contratoFormatado', 'dataSegundoLeilao','numeroLeilao', 'statusAverbacao')
        ->orderBy('dataSegundoLeilao', 'desc')
        ->get();

        return $criaPlanilha;
    }
    
    public function headings(): array
    {
        return [
            ["Contrato", "Data Segundo Leilão", "Número Leilão", "Status Averbação", "Data Segundo Leilão"],
        ];
    }

    public function columnFormats(): array
    {
        $criaPlanilha = $this->collection();
  
        return [
            'B' => Date::stringToExcel($criaPlanilha[1])
        ];
    }

}
