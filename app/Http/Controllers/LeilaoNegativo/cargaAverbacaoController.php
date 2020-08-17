<?php

namespace App\Http\Controllers\LeilaoNegativo;

use App\Classes\Ldap;
use App\TabelaImportExcel;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\LeilaoNegativo\LeilaoNegativo;
use App\Models\LeilaoNegativo\Codigo_correio_leilaoNegativo;
use App\Models\HistoricoPortalGilie;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\CriaExcelLeilaoNegativo;
use DOMDocument;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\averbacaoImport;

class cargaAverbacaoController extends Controller
{
    public function importaExcelAverbacao()
    {
        return view('portal.controle-arquivos.carga-leilao-negativo');
    }

    public function import(Request $request) 
    {
        try {
            
            $pathtofile = ($_FILES['arquivo']['name']);
           
            $info = pathinfo($pathtofile);
            if ($info["extension"] == "xlsx"){
            Excel::import(new averbacaoImport,request()->file('arquivo'));
          
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Cadastro realizado!");
            $request->session()->flash('corpoMensagem', "O upload foi realizado com sucesso.");
            }else{
                $request->session()->flash('corMensagem', 'danger');
                $request->session()->flash('tituloMensagem', "Não foi possivel cadatrar!");
                $request->session()->flash('corpoMensagem', "Envie apenas arquivos do Excel (XLS e XLSX)"); 
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
                 foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                foreach($failure->errors() as $key => $message){
                $key = $message;
                }
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Não foi possivel cadatrar!");
            $request->session()->flash('corpoMensagem', $message); 
            }
        }   
        
        return back();
    }

}
