<?php

namespace App\Http\Controllers\Equipes;

use App\Classes\DiasUteisClass;
use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\HistoricoPortalGilie;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use Maatwebsite\Excel\Facades\Excel;


class equipesController extends Controller
{
    public function equipeIndex()
    {
        return view('portal.informativas.equipe');
    }

    public function listaNomesEquipes()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
        ->select(DB::raw("
        TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
        TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
        TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
      "))
        ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', $codigoUnidadeUsuarioSessao)
        ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
        ->get(); 
        
        return json_encode($equipe);
    }

    public function listaEquipe()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $equipe = DB::table('TBL_GESTAO_EQUIPES_EMPREGADOS')
        ->join('TBL_EMPREGADOS', 'TBL_EMPREGADOS.matricula',  "=", 'TBL_GESTAO_EQUIPES_EMPREGADOS.matricula')
        ->leftjoin('TBL_GESTAO_EQUIPES_CELULAS', 'TBL_GESTAO_EQUIPES_CELULAS.idEquipe',  "=", 'TBL_GESTAO_EQUIPES_EMPREGADOS.idEquipe')
        ->select(DB::raw("
        TBL_GESTAO_EQUIPES_EMPREGADOS.[matricula] as matricula,
        TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
        TBL_EMPREGADOS.[primeiroNome] as primeiroNome,
        TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
        TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe
      "))
        ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', $codigoUnidadeUsuarioSessao)
        ->get(); 
        
        return json_encode($equipe);
    }

    public function listaAtividade()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $equipe = DB::table('TBL_GESTAO_EQUIPES_ATIVIDADES_RESPONSAVEIS')
        ->leftjoin('TBL_EMPREGADOS', 'TBL_EMPREGADOS.matricula',  "=", 'TBL_GESTAO_EQUIPES_ATIVIDADES_RESPONSAVEIS.matriculaResponsavelAtividade')
        ->leftjoin('TBL_GESTAO_EQUIPES_ATIVIDADES', 'TBL_GESTAO_EQUIPES_ATIVIDADES.idAtividade',  "=", 'TBL_GESTAO_EQUIPES_ATIVIDADES_RESPONSAVEIS.idAtividade')
        ->leftjoin('TBL_GESTAO_EQUIPES_CELULAS', 'TBL_GESTAO_EQUIPES_CELULAS.idEquipe',  "=", 'TBL_GESTAO_EQUIPES_ATIVIDADES.idEquipe')
        ->select(DB::raw("
        TBL_GESTAO_EQUIPES_ATIVIDADES_RESPONSAVEIS.[matriculaResponsavelAtividade] as matriculaResponsavel,
        TBL_GESTAO_EQUIPES_ATIVIDADES.[nomeAtividade] as nomeAtividade

      "))
        ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', $codigoUnidadeUsuarioSessao)
        ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
        ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
        ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
        ->get(); 
        
        return json_encode($equipe);
    }

 
  
}
