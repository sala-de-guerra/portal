<?php

namespace App\Imports;

use DateTime;

use App\User;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Vilop\MacroProcessoNovo;
use App\Models\Vilop\MicroProcessoNovo;
use App\Models\Vilop\TabelaRelacionamento;
use App\Models\Vilop\CargaMensal;
use App\Models\Vilop\ControleProcesso;
use Illuminate\Support\Facades\DB;
use Exception;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class produtividadeVilopImportNovo implements ToModel, WithValidation, WithStartRow
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
        if($row[3] == "SIM"){
            $row[3] = 'S';
        }elseif ($row[3] == "NÃO") {
            $row[3] = 'N';
        }
        $listaProcesso = DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')->where('NU_CGC', str_pad($row[0] , 4 , '0' , STR_PAD_LEFT))
        ->join('produtividade.TB_MACROPROCESSOS', DB::raw('CONVERT(VARCHAR, produtividade.TB_MACROPROCESSOS.ID_MACRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MACRO)'))
        ->where('DE_MACRO', $row[1])
        ->where('TB_RELACAO_CGC_MACRO_MICRO.IC_ATIVO', '1')
        ->first();

        if(is_object($listaProcesso)){

            $novaMicroAtividadeVilop = new MicroProcessoNovo();
            $novaMicroAtividadeVilop->DE_MICRO                          = $row[2];
            $novaMicroAtividadeVilop->IC_MENSURAVEL                     = $row[3];
            $novaMicroAtividadeVilop->CO_RESPONSAVEL_ATUALIZACAO        = session('matricula');
            $novaMicroAtividadeVilop->DT_ATUALIZACAO                    = date("Y-m-d H:i:s", time());
            $novaMicroAtividadeVilop->save();
            
    
            $dadosMicroAtividadeVilop = DB::table('produtividade.TB_MICROPROCESSO')->where('DE_MICRO', $row[2])
            ->orderBy('ID_MICRO', 'desc')->first(); 
            
            $novoRelVilop = new TabelaRelacionamento;
            $novoRelVilop->NU_CGC                            = str_pad($row[0], 4 , '0' , STR_PAD_LEFT);
            $novoRelVilop->ID_MACRO                          = $listaProcesso->ID_MACRO;
            $novoRelVilop->ID_MICRO                          = $dadosMicroAtividadeVilop->ID_MICRO;
            $novoRelVilop->IC_ATIVO                          = 1;
            $novoRelVilop->CO_RESPONSAVEL_ATUALIZACAO        = session('matricula');
            $novoRelVilop->DT_ATUALIZACAO                    = date("Y-m-d H:i:s", time());
            $novoRelVilop->save();
            
            
            $ControleProcesso = new ControleProcesso();
            
            $ControleProcesso->DT_CADASTRO               = date("Y-m-d H:i:s", time());
            if (isset($row[6])){
                $ControleProcesso->MM_REFERENCIA         = $row[6];
            }
            if (isset($row[7])){
                $ControleProcesso->AA_REFERENCIA        = $row[7] ;
            }
            $ControleProcesso->DT_ENVIO_DA_CARGA                      = date("Y-m-d H:i:s", time());
            $ControleProcesso->CO_MATRICULA_RESPONSAVEL_ENVIO         = session('matricula');
            $ControleProcesso->DT_PROCESSAMENTO          = NULL;
            $ControleProcesso->NU_CGC                    = str_pad($row[0], 4 , '0' , STR_PAD_LEFT);
            $ControleProcesso->save();
    
            $dadosCargaMensal= DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')->orderBy('ID_AG_MACRO_MICRO', 'desc')->first();
            $idCarga= DB::table('produtividade.TB_CONTROLE_PROCESSO')->orderBy('ID_CARGA', 'desc')->first();  
    
            $CargaMensal = new CargaMensal();
            $CargaMensal->ID_CARGA                        = $idCarga->ID_CARGA;
            $CargaMensal->ID_AG_MACRO_MICRO               = $dadosCargaMensal->ID_AG_MACRO_MICRO;
            $CargaMensal->QTDE_PESSOAS_ALOCADAS           = $row[16];
            if (isset($row[4])){
                $CargaMensal->VOLUME_TOTAL_DEMANDA        = $row[4];
            }else{
                $CargaMensal->VOLUME_TOTAL_DEMANDA        = null;
            }
    
            if (isset($row[5])){
                $CargaMensal->VOLUME_TOTAL_TRATADA        = $row[5];
            }else{
                $CargaMensal->VOLUME_TOTAL_TRATADA        = null;
            }
    
            $CargaMensal->DIAS_UTEIS                      = null;
    
            if (isset($row[8])){
                $CargaMensal->MEDIA_DIA                  = $row[8];
            }else{
                $CargaMensal->MEDIA_DIA                  = null;
            }
            if (isset($row[9])){
                $CargaMensal->TEMPO_EM_MINUTOS           = $row[9];
            }else{
                $CargaMensal->TEMPO_EM_MINUTOS           = null;
            }
    
            $CargaMensal->NIVEL_COMPLEXIDADE                    = $row[10];
            $CargaMensal->GRAU_CRITICIDADE                      = $row[12];
            $CargaMensal->NIVEL_AUTOMACAO                       = $row[11];
            $CargaMensal->GRAU_PADRONIZACAO                     = $row[13];
            $CargaMensal->GRAU_AUTONOMIA                        = $row[14];
            $CargaMensal->SISTEMA_ORIGEM_INFORMACAO             = $row[15];
            $CargaMensal->save();
            
        }else{
            
            $unidades = DB::table('TB_CAPTURA_UNIDADES_ATT')->where('codigoAgencia', str_pad($row[0] , 4 , '0' , STR_PAD_LEFT))->first();
            if(is_object($unidades)){
            
                if($row[3] == "SIM"){
                    $row[3] = 'S';
                }elseif ($row[3] == "NÃO") {
                    $row[3] = 'N';
                }

                $novaMacroAtividadeVilop = new MacroProcessoNovo;
                $novaMacroAtividadeVilop->DE_MACRO                          = $row[1];
                $novaMacroAtividadeVilop->CO_RESPONSAVEL_ATUALIZACAO        = session('matricula');
                $novaMacroAtividadeVilop->DT_ATUALIZACAO                    = date("Y-m-d H:i:s", time());
                $novaMacroAtividadeVilop->IC_ATIVO                          = 1;
                $novaMacroAtividadeVilop->save();

                   
                $listaProcesso = DB::table('produtividade.TB_MACROPROCESSOS')->where('DE_MACRO', $row[1])
                ->orderBy('ID_MACRO', 'desc')->first();  
                
                $novaMicroAtividadeVilop = new MicroProcessoNovo();
                $novaMicroAtividadeVilop->DE_MICRO                          = $row[2];
                $novaMicroAtividadeVilop->IC_MENSURAVEL                     = $row[3];
                $novaMicroAtividadeVilop->CO_RESPONSAVEL_ATUALIZACAO        = session('matricula');
                $novaMicroAtividadeVilop->DT_ATUALIZACAO                    = date("Y-m-d H:i:s", time());
                $novaMicroAtividadeVilop->save();
                
        
                $dadosMicroAtividadeVilop = DB::table('produtividade.TB_MICROPROCESSO')->where('DE_MICRO', $row[2])
                ->orderBy('ID_MICRO', 'desc')->first(); 
                
                $novoRelVilop = new TabelaRelacionamento;
                $novoRelVilop->NU_CGC                            = str_pad($row[0], 4 , '0' , STR_PAD_LEFT);
                $novoRelVilop->ID_MACRO                          = $listaProcesso->ID_MACRO;
                $novoRelVilop->ID_MICRO                          = $dadosMicroAtividadeVilop->ID_MICRO;
                $novoRelVilop->IC_ATIVO                          = 1;
                $novoRelVilop->CO_RESPONSAVEL_ATUALIZACAO        = session('matricula');
                $novoRelVilop->DT_ATUALIZACAO                    = date("Y-m-d H:i:s", time());
                $novoRelVilop->save();
                
                
                $ControleProcesso = new ControleProcesso();
                
                $ControleProcesso->DT_CADASTRO               = date("Y-m-d H:i:s", time());
                if (isset($row[6])){
                    $ControleProcesso->MM_REFERENCIA         = $row[6];
                }
                if (isset($row[7])){
                    $ControleProcesso->AA_REFERENCIA        = $row[7] ;
                }
                $ControleProcesso->DT_ENVIO_DA_CARGA                      = date("Y-m-d H:i:s", time());
                $ControleProcesso->CO_MATRICULA_RESPONSAVEL_ENVIO         = session('matricula');
                $ControleProcesso->DT_PROCESSAMENTO          = NULL;
                $ControleProcesso->NU_CGC                    = str_pad($row[0], 4 , '0' , STR_PAD_LEFT);
                $ControleProcesso->save();
        
                $dadosCargaMensal= DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')->orderBy('ID_AG_MACRO_MICRO', 'desc')->first();
                $idCarga= DB::table('produtividade.TB_CONTROLE_PROCESSO')->orderBy('ID_CARGA', 'desc')->first();  
        
                $CargaMensal = new CargaMensal();
                $CargaMensal->ID_CARGA                        = $idCarga->ID_CARGA;
                $CargaMensal->ID_AG_MACRO_MICRO               = $dadosCargaMensal->ID_AG_MACRO_MICRO;
                $CargaMensal->QTDE_PESSOAS_ALOCADAS           = $row[16];
                if (isset($row[4])){
                    $CargaMensal->VOLUME_TOTAL_DEMANDA        = $row[4];
                }else{
                    $CargaMensal->VOLUME_TOTAL_DEMANDA        = null;
                }
        
                if (isset($row[5])){
                    $CargaMensal->VOLUME_TOTAL_TRATADA        = $row[5];
                }else{
                    $CargaMensal->VOLUME_TOTAL_TRATADA        = null;
                }
        
                $CargaMensal->DIAS_UTEIS                      = null;
        
                if (isset($row[8])){
                    $CargaMensal->MEDIA_DIA                  = $row[8];
                }else{
                    $CargaMensal->MEDIA_DIA                  = null;
                }
                if (isset($row[9])){
                    $CargaMensal->TEMPO_EM_MINUTOS           = $row[9];
                }else{
                    $CargaMensal->TEMPO_EM_MINUTOS           = null;
                }
        
                $CargaMensal->NIVEL_COMPLEXIDADE                    = $row[10];
                $CargaMensal->NIVEL_AUTOMACAO                       = $row[11];
                $CargaMensal->GRAU_CRITICIDADE                      = $row[12];
                $CargaMensal->GRAU_PADRONIZACAO                     = $row[13];
                $CargaMensal->GRAU_AUTONOMIA                        = $row[14];
                $CargaMensal->SISTEMA_ORIGEM_INFORMACAO             = $row[15];
                $CargaMensal->save();
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

