<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TabelaImportExcel;
use App\Models\HistoricoPortalGilie;


  
class UploadexcelController extends Controller
{
    public function importaExcel()
    {
        return view('portal.silog.controle-arquivos');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {

    Excel::import(new UsersImport,request()->file('arquivo'));
 
    $request->session()->flash('corMensagem', 'success');
    $request->session()->flash('tituloMensagem', "Cadastro realizado!");
    $request->session()->flash('corpoMensagem', "O cadastro do Atende foi realizado com sucesso.");    
        
        return back();
    }

    public function listaUpload()
    {
        $upload = TabelaImportExcel::all();
        return json_encode($upload);
    }
}