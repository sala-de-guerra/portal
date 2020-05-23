<?php

namespace App\Exports;

use App\Models\LeilaoNegativo\LeilaoNegativo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Classes\Ldap;




class CriaExcelLeilaoNegativo implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $unidade = Ldap::defineUnidadeUsuarioSessao();
        $criaPlanilha = LeilaoNegativo::where('unidadeResponsavel', $unidade)
        ->select('contratoFormatado', 'dataSegundoLeilao', 'numeroLeilao', 'statusAverbacao')
        ->orderBy('dataSegundoLeilao', 'desc')
        ->get();
        return $criaPlanilha;
    }
    public function headings(): array
    {
        return [
            ["Contrato", "Data Segundo Leilão", "Número Leilão", "Status Averbação"],
        ];
    }
}
