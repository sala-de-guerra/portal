<?php

namespace App\Imports;

use DateTime;

use App\User;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Vilop\MacroProcesso;
use App\Models\Vilop\MicroProcesso;
use Illuminate\Support\Facades\DB;
use Exception;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class produtividadeVilopImport implements ToModel, WithValidation, WithStartRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    try {
        
        $listaProcesso = DB::table('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS')->where('CGC_UNIDADE', str_pad($row[0] , 4 , '0' , STR_PAD_LEFT))
        ->where('NOME_MACROATIVIDADE', $row[1])
        ->where('EXCLUIDO_USUARIO', 'N')
        ->first();

        if(is_object($listaProcesso)){
            $idMacroProcesso = $listaProcesso->IdMacro;         
            $novaMicroAtividadeVilop = new MicroProcesso;
            $novaMicroAtividadeVilop->NOME_MICROATIVIDADE             = $row[2];
            $novaMicroAtividadeVilop->IdMacroProcesso                 = $idMacroProcesso;
            $novaMicroAtividadeVilop->MENSURAVEL                      = $row[3];
            
            if (strtoupper($row[3]) == "SIM"){
                $novaMicroAtividadeVilop->MENSURAVEL                  = "S";
            }else{
                $novaMicroAtividadeVilop->MENSURAVEL                  = "N";
            }
            
            
            if (isset($row[5])){
                $novaMicroAtividadeVilop->VOLUME_TOTAL_DEMANDA        = $row[4];
            }else{
                $novaMicroAtividadeVilop->VOLUME_TOTAL_DEMANDA        = 0;
            }
            if (isset($row[6])){
                $novaMicroAtividadeVilop->VOLUME_TOTAL_TRATADA        = $row[5];
            }else{
                $novaMicroAtividadeVilop->VOLUME_TOTAL_TRATADA        = 0;
            }
            
            if (isset($row[6])){
                // dd(trim($row[6]));
                $dataDE   =  (trim($row[6]) - 25569) * 86400;
                // $dataDE = DateTime::createFromFormat('d/m/y',trim($row[6]));
                $novaMicroAtividadeVilop->PERIODO_TRATADO_DE                  = gmdate("Y-m-d", $dataDE);
            }
            if (isset($row[7])){
                // dd($row[7]);
                $dataPARA =  (trim($row[7]) - 25569) * 86400;
                // $dataPARA = DateTime::createFromFormat('d/m/y',trim($row[7]));
                $novaMicroAtividadeVilop->PERIODO_TRATADO_ATE                  = gmdate("Y-m-d", $dataPARA);
            }
            
            
            if (isset($row[9])){
                $novaMicroAtividadeVilop->MEDIA_DIA                  = $row[8];
            }else{
                $novaMicroAtividadeVilop->MEDIA_DIA                  = 0;
            }
            if (isset($row[10])){
                $novaMicroAtividadeVilop->TEMPO_EM_MINUTOS           = $row[9];
            }else{
                $novaMicroAtividadeVilop->TEMPO_EM_MINUTOS           = 0;
            }

            $novaMicroAtividadeVilop->NIVEL_COMPLEXIDADE                    = $row[10];
            $novaMicroAtividadeVilop->NIVEL_AUTOMACAO                       = $row[11];
            $novaMicroAtividadeVilop->GRAU_CRITICIDADE                      = $row[12];
            $novaMicroAtividadeVilop->GRAU_PADRONIZACAO                     = $row[13];
            $novaMicroAtividadeVilop->GRAU_AUTONOMIA                        = $row[14];
            $novaMicroAtividadeVilop->SISTEMA_ORIGEM_INFORMACAO             = $row[15];
            $novaMicroAtividadeVilop->EXCLUIDO_USUARIO                      = 'N';
            $novaMicroAtividadeVilop->QTDE_PESSOAS_ALOCADAS                 = $row[16];
            $novaMicroAtividadeVilop->RESPONSAVEL_CADASTRO_MICROATIVIDADE   = session('matricula');
            $novaMicroAtividadeVilop->MATRICULA_RESPONSAVEL_UPLOAD          = session('matricula');
            $novaMicroAtividadeVilop->DATA_UPLOAD                           = date("Y-m-d H:i:s", time());
            $novaMicroAtividadeVilop->save();
            
        }else{
            
            $unidades = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', str_pad($row[0] , 4 , '0' , STR_PAD_LEFT))->first();
            if(is_object($unidades)){
            $unidadeNome = $unidades->nomeAgencia;

            $novaMacroAtividadeVilop = new MacroProcesso;
            $novaMacroAtividadeVilop->CGC_UNIDADE                       = str_pad($row[0] , 4 , '0' , STR_PAD_LEFT);
            $novaMacroAtividadeVilop->NOME_UNIDADE                      = $unidadeNome;
            $novaMacroAtividadeVilop->NOME_MACROATIVIDADE               = $row[1];
            $novaMacroAtividadeVilop->EXCLUIDO_USUARIO                  = 'N';
            $novaMacroAtividadeVilop->MATRICULA_RESPONSAVEL_RESPOSTA    = session('matricula');
            $novaMacroAtividadeVilop->DATA_RESPOSTA                     = date("Y-m-d H:i:s", time());
            $novaMacroAtividadeVilop->save();

            $listaProcesso = DB::table('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS')->where('CGC_UNIDADE', str_pad($row[0] , 4 , '0' , STR_PAD_LEFT))
            ->where('NOME_MACROATIVIDADE', $row[1])
            ->where('EXCLUIDO_USUARIO', 'N')
            ->first();

            $idMacroProcesso = $listaProcesso->IdMacro;

            
            
                        
            $novaMicroAtividadeVilop = new MicroProcesso;
            $novaMicroAtividadeVilop->NOME_MICROATIVIDADE             = $row[2];
            $novaMicroAtividadeVilop->IdMacroProcesso                 = $idMacroProcesso;
            if (strtoupper($row[3]) == "SIM"){
                $novaMicroAtividadeVilop->MENSURAVEL                  = "S";
            }else{
                $novaMicroAtividadeVilop->MENSURAVEL                  = "N";
            }
            if (isset($row[4])){
                $novaMicroAtividadeVilop->VOLUME_TOTAL_DEMANDA        = $row[4];
            }else{
                $novaMicroAtividadeVilop->VOLUME_TOTAL_DEMANDA        = 0;
            }
            if (isset($row[5])){
                $novaMicroAtividadeVilop->VOLUME_TOTAL_TRATADA        = $row[5];
            }else{
                $novaMicroAtividadeVilop->VOLUME_TOTAL_TRATADA        = 0;
            }
            if (isset($row[6])){
                // dd($row[6]);
                $dataDE   =  (trim($row[6]) - 25569) * 86400;
                // $dataDE = DateTime::createFromFormat('d/m/y',trim($row[6]));
                $novaMicroAtividadeVilop->PERIODO_TRATADO_DE                  = gmdate("Y-m-d", $dataDE);
            }
            if (isset($row[7])){
                $dataPARA =  (trim($row[7]) - 25569) * 86400;
                // $dataPARA = DateTime::createFromFormat('d/m/y',trim($row[7]));
                $novaMicroAtividadeVilop->PERIODO_TRATADO_ATE                  = gmdate("Y-m-d", $dataPARA);
            }
            if (isset($row[9])){
                $novaMicroAtividadeVilop->MEDIA_DIA                  = $row[8];
            }else{
                $novaMicroAtividadeVilop->MEDIA_DIA                  = 0;
            }
            if (isset($row[10])){
                $novaMicroAtividadeVilop->TEMPO_EM_MINUTOS           = $row[9];
            }else{
                $novaMicroAtividadeVilop->TEMPO_EM_MINUTOS           = 0;
            }

            $novaMicroAtividadeVilop->NIVEL_COMPLEXIDADE                    = $row[10];
            $novaMicroAtividadeVilop->NIVEL_AUTOMACAO                       = $row[11];
            $novaMicroAtividadeVilop->GRAU_CRITICIDADE                      = $row[12];
            $novaMicroAtividadeVilop->GRAU_PADRONIZACAO                     = $row[13];
            $novaMicroAtividadeVilop->GRAU_AUTONOMIA                        = $row[14];
            $novaMicroAtividadeVilop->SISTEMA_ORIGEM_INFORMACAO             = $row[15];
            $novaMicroAtividadeVilop->EXCLUIDO_USUARIO                      = 'N';
            $novaMicroAtividadeVilop->QTDE_PESSOAS_ALOCADAS                 = $row[16];
            $novaMicroAtividadeVilop->RESPONSAVEL_CADASTRO_MICROATIVIDADE   = session('matricula');
            $novaMicroAtividadeVilop->MATRICULA_RESPONSAVEL_UPLOAD          = session('matricula');
            $novaMicroAtividadeVilop->DATA_UPLOAD                           = date("Y-m-d H:i:s", time());
            $novaMicroAtividadeVilop->save();
            }else{
                unset($row[0]);
            }     
        }}catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
                 foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                foreach($failure->errors() as $key => $message){
                $key = $message;
                }
                return back();
            }
        }       
    }

    public function rules(): array
    {
        return [
            '0' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna CGC_UNIDADE não pode ter célula vazia'); 
                } 
            },
            '1' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna NOME_MACROATIVIDADE não pode ter célula vazia'); 
                } 
            },
            '2' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna MICROATIVIDADE não pode ter célula vazia'); 
                } 
            },
            '3' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna MENSURAVEL não pode ter célula vazia'); 
                } 
            },
            '10' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna NIVEL_COMPLEXIDADE não pode ter célula vazia'); 
                } 
            },
            '11' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna NIVEL_AUTOMACAO não pode ter célula vazia'); 
                } 
            },
            '12' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna GRAU_CRITICIDADE não pode ter célula vazia'); 
                } 
            },
            '13' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna GRAU_PADRONIZACAO não pode ter célula vazia'); 
                } 
            },
            '14' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna GRAU_AUTONOMIA não pode ter célula vazia'); 
                } 
            },
            '16' => function($attribute, $value, $onFailure) { 
                if (!isset($value)) {
                    $onFailure('Coluna QTDE_PESSOAS_ALOCADAS não pode ter célula vazia, caso todas as células desta coluna estejam preenchidas, delete as últimas linhas em branco.'); 
                } 
            },
        ];
    }
    public function startRow(): int
    {
        return 2;
    }

}

