<?php

namespace App\Imports;

use App\User;
use App\Models\TabelaImportExcel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\HistoricoPortalGilie;
use App\Models\LeilaoNegativo\LeilaoNegativoEmLote;


class averbacaoImport implements ToModel, WithValidation, WithStartRow
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
        $historico->tipo            = "REMESSA EM LOTE";
        $historico->atividade       = "LEILÃO NEGATIVO";
        $historico->observacao      = "Averbação Leilão Negativo";
        $historico->created_at      = date("Y-m-d H:i:s", time());
        $historico->updated_at      = date("Y-m-d H:i:s", time());
        $historico->save();

        // CAPTURA OS DADOS DA DEMANDA
        if ($atualizarContratoLeilaoNegativo = LeilaoNegativoEmLote::find($row[0])){
            $atualizarContratoLeilaoNegativo = LeilaoNegativoEmLote::find($row[0]);
            $atualizarContratoLeilaoNegativo->statusAverbacao = 'AVERBACAO CONCLUIDA';
            $atualizarContratoLeilaoNegativo->dataAlteracao = date("Y-m-d H:i:s", time());
            $atualizarContratoLeilaoNegativo->save();
            }else{
                unset($row[0]);
            }
    }

    public function rules(): array
    {
        return [
            '0' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna Contrato não pode ter célula vazia'); 
                } 
            },

            '0' => function($attribute, $value, $onFailure) { 
                if (strlen($value) != 17) {
                    $onFailure('Enviar apenas contrato formatado'); 
                } 
            }
        ];
    }
    public function startRow(): int
    {
        return 2;
    }


}

