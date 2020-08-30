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

// SÃO PAULO
    public function listaNomesEquipes()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
        ->select(DB::raw("
        TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
        TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
        TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
        TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
        TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
        TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
      "))
        ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7257')
        ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
        ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
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
        ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7257')
        ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
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
        ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7257')
        ->where('TBL_GESTAO_EQUIPES_ATIVIDADES_RESPONSAVEIS.atuandoAtividade', '1')
        ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
        ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
        ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
        ->get(); 
        
        return json_encode($equipe);
    }

    public function listaGerenteSP()
    {
        $equipe = DB::table('TBL_EMPREGADOS')
        ->select(DB::raw("
        TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
        TBL_EMPREGADOS.[matricula] as matricula

      "))
        ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7257')
        ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
        ->get(); 
        
        return json_encode($equipe);
    }


  //PORTO ALEGRE

  public function listaGerentePO()
  {
      $equipe = DB::table('TBL_EMPREGADOS')
      ->select(DB::raw("
      TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
      TBL_EMPREGADOS.[matricula] as matricula
    "))
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7251')
      ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
      ->get(); 
      
      return json_encode($equipe);
  }


  public function listaNomesEquipesPO()
  {
      $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
      $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
      ->select(DB::raw("
      TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
    "))
      ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7251')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaEquipePO()
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
      ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7251')
      ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaAtividadePO()
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
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7251')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  //BELO HORIZONTE

  public function listaGerenteBH()
  {
      $equipe = DB::table('TBL_EMPREGADOS')
      ->select(DB::raw("
      TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
      TBL_EMPREGADOS.[matricula] as matricula
    "))
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7244')
      ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
      ->get(); 
      
      return json_encode($equipe);
  }


  public function listaNomesEquipesBH()
  {
      $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
      $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
      ->select(DB::raw("
      TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
    "))
      ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7244')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaEquipeBH()
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
      ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7244')
      ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaAtividadeBH()
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
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7244')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  //BAURU
  public function listaGerenteBU()
  {
      $equipe = DB::table('TBL_EMPREGADOS')
      ->select(DB::raw("
      TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
      TBL_EMPREGADOS.[matricula] as matricula
    "))
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7242')
      ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
      ->get(); 
      
      return json_encode($equipe);
  }


  public function listaNomesEquipesBU()
  {
      $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
      $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
      ->select(DB::raw("
      TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
    "))
      ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7242')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaEquipeBU()
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
      ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7242')
      ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaAtividadeBU()
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
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7242')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  //BELEM
  public function listaGerenteBE()
  {
      $equipe = DB::table('TBL_EMPREGADOS')
      ->select(DB::raw("
      TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
      TBL_EMPREGADOS.[matricula] as matricula
    "))
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7243')
      ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaNomesEquipesBE()
  {
      $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
      $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
      ->select(DB::raw("
      TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
    "))
      ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7243')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaEquipeBE()
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
      ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7243')
      ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaAtividadeBE()
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
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7243')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }
  
  //BRASILIA
    public function listaGerenteBR()
    {
        $equipe = DB::table('TBL_EMPREGADOS')
        ->select(DB::raw("
        TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
        TBL_EMPREGADOS.[matricula] as matricula
      "))
        ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7109')
        ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
        ->get(); 
        
        return json_encode($equipe);
    }

  public function listaNomesEquipesBR()
  {
      $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
      $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
      ->select(DB::raw("
      TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
    "))
      ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7109')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaEquipeBR()
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
      ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7109')
      ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaAtividadeBR()
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
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7109')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  //CURITIBA
  public function listaGerenteCT()
  {
      $equipe = DB::table('TBL_EMPREGADOS')
      ->select(DB::raw("
      TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
      TBL_EMPREGADOS.[matricula] as matricula
    "))
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7247')
      ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaNomesEquipesCT()
  {
      $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
      $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
      ->select(DB::raw("
      TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
    "))
      ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7247')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaEquipeCT()
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
      ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7247')
      ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaAtividadeCT()
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
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7247')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }
    //FORTALEZA
    public function listaGerenteFO()
    {
        $equipe = DB::table('TBL_EMPREGADOS')
        ->select(DB::raw("
        TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
        TBL_EMPREGADOS.[matricula] as matricula
      "))
        ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7248')
        ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
        ->get(); 
        
        return json_encode($equipe);
    }

  public function listaNomesEquipesFO()
  {
      $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
      $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
      ->select(DB::raw("
      TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
    "))
      ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7248')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaEquipeFO()
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
      ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7248')
      ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaAtividadeFO()
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
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7248')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }
  //GOIANIA

  public function listaGerenteGO()
  {
      $equipe = DB::table('TBL_EMPREGADOS')
      ->select(DB::raw("
      TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
      TBL_EMPREGADOS.[matricula] as matricula
    "))
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7249')
      ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaNomesEquipesGO()
  {
      $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
      $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
      ->select(DB::raw("
      TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
    "))
      ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7249')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaEquipeGO()
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
      ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7249')
      ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaAtividadeGO()
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
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7249')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }
  //RIO DE JANEIRO
  public function listaGerenteRJ()
  {
      $equipe = DB::table('TBL_EMPREGADOS')
      ->select(DB::raw("
      TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
      TBL_EMPREGADOS.[matricula] as matricula
    "))
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7254')
      ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaNomesEquipesRJ()
  {
      $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
      $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
      ->select(DB::raw("
      TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
    "))
      ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7254')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaEquipeRJ()
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
      ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7254')
      ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaAtividadeRJ()
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
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7254')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  //RECIFE
  public function listaGerenteRE()
  {
      $equipe = DB::table('TBL_EMPREGADOS')
      ->select(DB::raw("
      TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
      TBL_EMPREGADOS.[matricula] as matricula
    "))
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7253')
      ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaNomesEquipesRE()
  {
      $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
      $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
      ->select(DB::raw("
      TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
      TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
      TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
    "))
      ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7253')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaEquipeRE()
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
      ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7253')
      ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  public function listaAtividadeRE()
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
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7253')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
      ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
      ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
      ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
      ->get(); 
      
      return json_encode($equipe);
  }

  //SALVADOR
  public function listaGerenteSA()
  {
      $equipe = DB::table('TBL_EMPREGADOS')
      ->select(DB::raw("
      TBL_EMPREGADOS.[nomeCompleto] as nomeCompleto,
      TBL_EMPREGADOS.[matricula] as matricula
    "))
      ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7255')
      ->where('TBL_EMPREGADOS.nomeFuncao', 'GERENTE DE FILIAL')
      ->get(); 
      
      return json_encode($equipe);
  }

public function listaNomesEquipesSA()
{
    $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
    $equipe = DB::table('TBL_GESTAO_EQUIPES_CELULAS')
    ->select(DB::raw("
    TBL_GESTAO_EQUIPES_CELULAS.[idEquipe] as idEquipe,
    TBL_GESTAO_EQUIPES_CELULAS.[nomeEquipe] as nomeEquipe,
    TBL_GESTAO_EQUIPES_CELULAS.[nomeEventual] as nomeEventual,
    TBL_GESTAO_EQUIPES_CELULAS.[matriculaEventual] as matriculaEventual,
    TBL_GESTAO_EQUIPES_CELULAS.[matriculaGestor] as matriculaGestor,
    TBL_GESTAO_EQUIPES_CELULAS.[nomeGestor] as nomeGestor
  "))
    ->where('TBL_GESTAO_EQUIPES_CELULAS.codigoUnidadeEquipe', '7255')
    ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
    ->orderBy('TBL_GESTAO_EQUIPES_CELULAS.nomeEquipe', 'asc')
    ->get(); 
    
    return json_encode($equipe);
}

public function listaEquipeSA()
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
    ->where('TBL_GESTAO_EQUIPES_EMPREGADOS.codigoUnidadeLotacao', '7255')
    ->orderBy('TBL_EMPREGADOS.nomeCompleto', 'asc')
    ->get(); 
    
    return json_encode($equipe);
}

public function listaAtividadeSA()
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
    ->where('TBL_EMPREGADOS.codigoLotacaoAdministrativa', '7255')
    ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeSubordinada', '0')
    ->where('TBL_GESTAO_EQUIPES_ATIVIDADES.atividadeAtiva', '1')
    ->where('TBL_GESTAO_EQUIPES_CELULAS.ativa', '1')
    ->orderBy('TBL_GESTAO_EQUIPES_ATIVIDADES.nomeAtividade', 'asc')
    ->get(); 
    
    return json_encode($equipe);
}
}
