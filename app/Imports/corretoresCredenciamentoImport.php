<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\CorretorCadastramento;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class corretoresCredenciamentoImport implements ToModel, WithValidation, WithStartRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // CAPTURA OS DADOS DA DEMANDA
        if ($CorretorCadastramento = CorretorCadastramento::find($row[0])){
            $CorretorCadastramento = CorretorCadastramento::find($row[0]);
            $CorretorCadastramento->numeroContrato     = $row[5];
            if (isset($row[6])){
            $CorretorCadastramento->dataConvoc         = $row[6] - 2;
            }else{
                unset($row[6]);
            }
            $CorretorCadastramento->contratoDevolvido  = $row[7];
            $CorretorCadastramento->SICAF              = $row[11];
            $CorretorCadastramento->dataUltimoUpload       = date("Y-m-d H:i:s", time());
            $CorretorCadastramento->matriculaUltimoUpload  = session('matricula');
            $CorretorCadastramento->save();
            }else{
                unset($row[0]);
            }
    }

    public function rules(): array
    {
        return [
            '0' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna Processo não pode ter célula vazia'); 
                } 
            },
        ];
    }
    public function startRow(): int
    {
        return 2;
    }

}

