<?php

namespace App\Imports;

use App\User;
use App\Models\TabelaImportExcel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\HistoricoPortalGilie;


class UsersImport implements ToModel, WithValidation, WithStartRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // CADASTRA HISTÓRICO
        $historico = new HistoricoPortalGilie;
        $historico->matricula       = session('matricula');
        $historico->numeroContrato  = $row[0];
        $historico->tipo            = "CADASTRO";
        $historico->atividade       = "CONTROLE DE ENVIO";
        $historico->observacao      = "ENVIO DE CAIXA DE CONTROLE CODIGO: " .  $row[2];
        $historico->created_at      = date("Y-m-d H:i:s", time());
        $historico->updated_at      = date("Y-m-d H:i:s", time());
        $historico->save();

        return new TabelaImportExcel([
            'Contrato'     => $row[0],
            'Caixa'        => $row[1],
            'Silog'        => $row[2],
            'Matricula'    => session('matricula'),
            'GILIE'    => session('codigoLotacaoAdministrativa')

        ]);  
    }

    public function rules(): array
    {
        return [
            '0' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna Contrato não pode ter célula vazia'); 
                } 
            },

            '1' =>function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('coluna CAIXA não pode ter célula vazia'); 
                } 
            },

            '2' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna Silog não pode ter célula vazia'); 
                } 
            }
        ];
    }
    public function startRow(): int
    {
        return 2;
    }


}

