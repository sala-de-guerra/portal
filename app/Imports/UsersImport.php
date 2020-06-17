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
        $historico->numeroContrato  = $row[2];
        $historico->tipo            = "REMESSA";
        $historico->atividade       = "PROCESSO EMGEA";
        $historico->observacao      = "ENVIO DE CAIXA EMGEA À GILIE/PO - CODIGO SILOG: " .  $row[8] . " CAIXA NÚMERO: ". $row[7];
        $historico->created_at      = date("Y-m-d H:i:s", time());
        $historico->updated_at      = date("Y-m-d H:i:s", time());
        $historico->save();

        return new TabelaImportExcel([
            'DataInclusaoPlanilha'             => $row[0],
            'MatriculaInclusaoPlanilha'        => $row[1],
            'Contrato'                         => $row[2],
            'NU_BEM'                           => $row[3],
            'Classificacao'                    => $row[4],
            'Status'                           => $row[5],
            'Coluna1'                          => $row[6],
            'Caixa'                            => $row[7],
            'Silog'                            => $row[8],
            'Matricula'    => session('matricula'),
            'GILIE'    => session('codigoLotacaoAdministrativa')

        ]);  
    }

    public function rules(): array
    {
        return [
            '2' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna Contrato não pode ter célula vazia'); 
                } 
            },

            '2' => function($attribute, $value, $onFailure) { 
                if (strlen($value) != 17) {
                    $onFailure('Enviar apenas contrato formatado'); 
                } 
            },

            '7' =>function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('coluna CAIXA não pode ter célula vazia'); 
                } 
            },

            '8' => function($attribute, $value, $onFailure) { 
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

