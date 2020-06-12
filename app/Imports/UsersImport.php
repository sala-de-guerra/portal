<?php

namespace App\Imports;

use App\User;
use App\Models\TabelaImportExcel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\HistoricoPortalGilie;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
            if (!isset($row['contrato'])) {
                return null;
            }

        return new TabelaImportExcel([
            'Contrato'     => $row['contrato'],
            'caixa'        => $row['caixa'],
            'silog'        => $row['silog']

        ]);
    }

}

