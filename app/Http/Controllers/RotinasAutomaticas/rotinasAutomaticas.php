<?php


namespace App\Http\Controllers\RotinasAutomaticas;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\HistoricoPortalGilie;
use App\Classes\DiasUteisClass;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\criaExcelSAPGeral;

class rotinasAutomaticas extends Controller
{
    public function index()
    {
        return view('portal.gerencial.rotinas-automaticas');
    }

    public function listaUniversoRotinas()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $listaRotinas = DB::table('TBL_DADOS_ROTINAS')
        ->leftjoin('ALITB001_Imovel_Completo', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_BEM)'), '=', DB::raw('CONVERT(VARCHAR, TBL_DADOS_ROTINAS.Contrato)'))    
        ->select(DB::raw("
        TBL_DADOS_ROTINAS.[processo],
        TBL_DADOS_ROTINAS.[dataAtualizacao],
        TBL_DADOS_ROTINAS.[status],
        TBL_DADOS_ROTINAS.[observacao],
        ALITB001_Imovel_Completo.[UNA] as gilie,
      "))
        ->get(); 
        
        return json_encode($listaRotinas);
    }
    
}
