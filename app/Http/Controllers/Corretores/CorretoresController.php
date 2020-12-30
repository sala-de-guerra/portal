<?php

namespace App\Http\Controllers\Corretores;

use Illuminate\Http\Request;
use App\Classes\Ldap;
use Illuminate\Support\Facades\DB;
use App\Exports\criaExcelCorretores;
use App\Exports\criaExcelCorretoresCredenciamento;
use App\TabelaImportExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\QualificaCorretor;
use App\Models\CorretorCadastramento;
use App\Models\EditalCorretor;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use PHPMailer\PHPMailer\PHPMailer;
use App\Classes\DiasUteisClass;
use Illuminate\Support\Carbon;
use App\Models\HistoricoPortalGilie;
use App\Imports\corretoresCredenciamentoImport;

class CorretoresController
{
    public function Corretores()
    {
        return view ('portal.Corretores.corretores');
        
    }
    public function viewCorretoresCredenciamento()
    {
        return view ('portal.Corretores.credenciamento-corretores');
        
    }
    public function listaCorretores()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)')) 
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7257')
        ->get();

         return json_encode($corretores);
        
    }

    public function listaCorretoresSA()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7255')
        ->get();

         return json_encode($corretores);
        
    }

    public function listaCorretoresRE()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7253')
        ->get();

         return json_encode($corretores);
        
    }

    public function listaCorretoresRJ()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7254')
        ->get();

         return json_encode($corretores);
        
    }

    public function listaCorretoresPO()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7251')
        ->get();

         return json_encode($corretores);
        
    }

    public function listaCorretoresGO()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7249')
        ->get();

         return json_encode($corretores);
        
    }

        public function listaCorretoresFO()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7248')
        ->get();

         return json_encode($corretores);
        
    }

    public function listaCorretoresCT()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7247')
        ->get();

         return json_encode($corretores);
        
    }

    public function listaCorretoresBR()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7109')
        ->get();

         return json_encode($corretores);
        
    }

    public function listaCorretoresBE()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7243')
        ->get();

         return json_encode($corretores);
        
    }

    public function listaCorretoresBU()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7242')
        ->get();

         return json_encode($corretores);
        
    }

    public function listaCorretoresBH()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->join('TBL_CORRETORES_EDITAIS', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_EDITAIS.GILIE)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.GILIE)'))   
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO] as dataVencimento,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacao,
        TBL_CORRETORES.[GILIE] as GILIE,
        TBL_CORRETORES_EDITAIS.[edital] as EDITAL
      "))
        ->where('TBL_CORRETORES.DT_VENCIMENTO_CONTRATO', '>=', $date)
        ->where('TBL_CORRETORES.GILIE', '7244')
        ->get();

         return json_encode($corretores);
        
    }

    public function criaPlanilhaExcelCorretores()
    {

        return Excel::download(new criaExcelCorretores, 'PlanilhaCorretores.xlsx');
    }

        public function atualizaQualificação(Request $request)
    {
      try {
        DB::beginTransaction();
        $atualizaCorretor = QualificaCorretor::updateOrCreate(
          ['NU_CPF_CORRETOR' => $request->cpfCorretor],
          [
              'NO_CORRETOR'                  => $request->nomeCorretor,
              'QUALIFICACAO'                 => $request->qualificacao,
              'GILIE'                        => $request->gilie,
              'DT_VENCIMENTO_CONTRATO'       => $request->vencimento
          ]
      );
      $request->session()->flash('corMensagem', 'success');
      $request->session()->flash('tituloMensagem', "Alteração realizada!");
      $request->session()->flash('corpoMensagem', "O cadastro do corretor foi alterado com sucesso.");

    DB::commit();
      } catch (\Throwable $th) {
          if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
          } else {
              AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
          }
          DB::rollback();
          // RETORNA A FLASH MESSAGE
          $request->session()->flash('corMensagem', 'danger');
          $request->session()->flash('tituloMensagem', "Edição não efetuada");
          $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a edição dos dados. Tente novamente");
      }
      return back();

    }

        public function enviaMensagemCorretor($corretor)
    {

      try { 
      $dadosCorretor = DB::table('TBL_CORRETORES')->where('NU_CPF_CORRETOR', $corretor)->first();  
      
      $mensagemCorretor = file_get_contents(("orientacaoefetivacaocontratacaoCorretor.php"), dirname(__FILE__));
      $mensagemCorretor = str_replace("%CORRETOR%", $dadosCorretor->NO_CORRETOR, $mensagemCorretor);

      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->CharSet = 'UTF-8'; 
      $mail->isHTML(true);                                         
      $mail->Host = 'sistemas.correiolivre.caixa';  
      $mail->SMTPAuth = false;                                  
      $mail->Port = 25;
      // $mail->SMTPDebug = 2;
      $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
      $mail->addReplyTo('GILIESP01@caixa.gov.br');
      if (env('APP_ENV') == 'PRODUCAO'){
        $mail->addAddress($dadosCorretor->ED_EMAIL_PESSOA);
        $mail->addCC( session('matricula') . '@mail.caixa');
        $mail->addBCC('GILIESP09@caixa.gov.br');
        $mail->addBCC('c142639@caixa.gov.br');
        $mail->addBCC('c098453@caixa.gov.br');
      }else{
          $mail->addAddress('c098453@mail.caixa');
          $mail->addCC('c142639@mail.caixa');
          $mail->addCC('c090120@mail.caixa');
      }
      $mail->Subject = 'Orientações para efetivação de contratação - Credenciamento de corretores e imobiliárias';
      $mail->Body = $mensagemCorretor;
      $mail->send();

      session()->flash('corMensagem', 'success');
      session()->flash('tituloMensagem', "Mensagem enviada");
      session()->flash('corpoMensagem', "A sua mensagem foi enviada com sucesso.");

    } catch (\Throwable $th) {
      AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
      DB::rollback();
      // RETORNA A FLASH MESSAGE
      session()->flash('corMensagem', 'danger');
      session()->flash('tituloMensagem', "Algo deu errado!!!");
      session()->flash('corpoMensagem', "Tente novamente");
  }

      return back();
    }

    public function enviaMensagemCecot($corretor,  Request $request)
    {

      try { 
      $dadosCorretor = DB::table('TBL_CORRETORES')->where('NU_CPF_CORRETOR', $corretor)->first(); 
      $editalCorretor = DB::table('TBL_CORRETORES_EDITAIS')->where('GILIE', $request->gilie)->first(); 
      switch ($request->gilie) {
        case '7257':
            $una = 'GILIE/SP';
            break;
        case '7244':
            $una = 'GILIE/BH';
            break;
          case '7242':
            $una = 'GILIE/BU';
            break;
        case '7243':
            $una = 'GILIE/BE';
            break;
          case '7109':
            $una = 'GILIE/BR';
            break;
        case '7247':
            $una = 'GILIE/CT';
            break;
          case '7248':
            $una = 'GILIE/FO';
            break;
        case '7249':
            $una = 'GILIE/GO';
            break;
          case '7251':
            $una = 'GILIE/PO';
            break;
        case '7254':
            $una = 'GILIE/RJ';
            break;
          case '7253':
            $una = 'GILIE/RE';
            break;
        case '7255':
            $una = 'GILIE/SA';
            break;                  
    }

      $mensagemCecot = file_get_contents(("confirmacaoCorretorCecot15.php"), dirname(__FILE__));
      $mensagemCecot = str_replace("%CORRETOR%", $dadosCorretor->NO_CORRETOR, $mensagemCecot);
      $mensagemCecot = str_replace("%CPFCORRETOR%", $dadosCorretor->NU_CPF_CORRETOR, $mensagemCecot);
      $mensagemCecot = str_replace("%EDITAL_CORRETOR%", $editalCorretor->edital, $mensagemCecot);
      $mensagemCecot = str_replace("%GILIE%", $una, $mensagemCecot);

      $mailCecot = new PHPMailer(true);
      $mailCecot->isSMTP();
      $mailCecot->CharSet = 'UTF-8'; 
      $mailCecot->isHTML(true);                                         
      $mailCecot->Host = 'sistemas.correiolivre.caixa';  
      $mailCecot->SMTPAuth = false;                                  
      $mailCecot->Port = 25;
      // $mail->SMTPDebug = 2;
      $mailCecot->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
      $mailCecot->addReplyTo('GILIESP01@caixa.gov.br');
      if (env('APP_ENV') == 'PRODUCAO'){
          $mailCecot->addAddress('CECOT15@caixa.gov.br');
          $mailCecot->addCC( session('matricula') . '@mail.caixa');
          $mailCecot->addBCC('GILIESP09@caixa.gov.br');
          $mailCecot->addBCC('c142639@caixa.gov.br');
          $mailCecot->addBCC('c098453@caixa.gov.br');
      }else{
          $mailCecot->addAddress('c098453@mail.caixa');
          $mailCecot->addCC('c142639@mail.caixa');
      }
      $mailCecot->Subject = 'Solicitação de efetivação de contratação';
      $mailCecot->Body = $mensagemCecot;
      $mailCecot->send();

      session()->flash('corMensagem', 'success');
      session()->flash('tituloMensagem', "Mensagem enviada");
      session()->flash('corpoMensagem', "A sua mensagem foi enviada com sucesso.");

    } catch (\Throwable $th) {
      AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
      DB::rollback();
      // RETORNA A FLASH MESSAGE
      session()->flash('corMensagem', 'danger');
      session()->flash('tituloMensagem', "Algo deu errado!!!");
      session()->flash('corpoMensagem', "Tente novamente");
  }

      return back();
    }

    public function disparaMensagemGILIEvendaCorretorPreHabilitado()
    {
      $ultimoDiaUtil = DiasUteisClass::retornaPassadoEmQuantidadeDiasUteis(Carbon::now(), 1, 'Y-m-d');
      $ultimoDiaUtil = '2020-12/28';
     
        $listaCorretoresEnvioEmailCecot= DB::table('ALITB001_Imovel_Completo') 
        ->leftjoin('TBL_CORRETORES', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CRECI)'), '=', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.NU_CRECI)')) 
        ->leftjoin('TBL_CORRETORES_QUALIFICACAO', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES_QUALIFICACAO.NU_CPF_CORRETOR)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CORRETORES.NU_CPF_CORRETOR)'))  
        ->select(DB::raw("
        ALITB001_Imovel_Completo.[NO_CORRETOR] as CORRETOR,
        TBL_CORRETORES.[NU_CPF_CORRETOR] as cpfCorretor,
        ISNULL(ALITB001_Imovel_Completo.[EMAIL_CORRETOR], 'giliesp01@caixa.gov.br') as emailCorretor,
        ALITB001_Imovel_Completo.[NU_BEM] as nuBem,
        IsNull(TBL_CORRETORES_QUALIFICACAO.[QUALIFICACAO] , 'Pré-habilitado') as qualificacaoCorretor,
        TBL_CORRETORES.NU_CRECI,
        ALITB001_Imovel_Completo.UNA

      "))
        ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', 'Vendido')
        ->where('ALITB001_Imovel_Completo.DATA_ALTERACAO_STATUS', $ultimoDiaUtil)
        ->where('ALITB001_Imovel_Completo.NO_CORRETOR', "!=", null)
        ->where('ALITB001_Imovel_Completo.UNA', 'GILIE/SP')
        ->distinct('ALITB001_Imovel_Completo.NU_BEM')->get();

       

        // return json_encode($listaCorretoresEnvioEmailCecot);

          foreach ($listaCorretoresEnvioEmailCecot as $corretor){
              if ($corretor->qualificacaoCorretor == 'Pré-habilitado'){
                try { 

                  $mensagemGILIE = file_get_contents(("emailAvisoVendaPreHabilitado.php"), dirname(__FILE__));
                  $mensagemGILIE = str_replace("%CREDENCIADO%", $corretor->CORRETOR, $mensagemGILIE);
                  $mensagemGILIE = str_replace("%CHB%", $corretor->nuBem, $mensagemGILIE);
 
            
                  $mailGILIE = new PHPMailer(true);
                  $mailGILIE->isSMTP();
                  $mailGILIE->CharSet = 'UTF-8'; 
                  $mailGILIE->isHTML(true);                                         
                  $mailGILIE->Host = 'sistemas.correiolivre.caixa';  
                  $mailGILIE->SMTPAuth = false;                                  
                  $mailGILIE->Port = 25;
                  // $mail->SMTPDebug = 2;
                  $mailGILIE->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
                  $mailGILIE->addReplyTo('GILIESP01@caixa.gov.br');
                  if (env('APP_ENV') == 'PRODUCAO'){
                    $mailGILIE->addBCC('GILIESP09@caixa.gov.br');
                    $mailGILIE->addBCC('c142639@mail.caixa');
                    $mailGILIE->addBCC('c098453@mail.caixa');
                  }else{
                      $mailGILIE->addAddress('c098453@mail.caixa');
                      $mailGILIE->addBCC('c142639@mail.caixa');
                  }
                  $mailGILIE->Subject = 'Solicitação de efetivação de contratação';
                  $mailGILIE->Body = $mensagemGILIE;
                  $mailGILIE->send();

            
                  session()->flash('corMensagem', 'success');
                  session()->flash('tituloMensagem', "Mensagem enviada");
                  session()->flash('corpoMensagem', "A sua mensagem foi enviada com sucesso.");

                } catch (\Throwable $th) {
                      AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
                      DB::rollback();
                      // RETORNA A FLASH MESSAGE
                      session()->flash('corMensagem', 'danger');
                      session()->flash('tituloMensagem', "Algo deu errado!!!");
                      session()->flash('corpoMensagem', "Tente novamente");
                    }
                }
            }  
            return back();
    }

    public function cadastraEdital(Request $request)
    {
      try {
        DB::beginTransaction();
       
        $cadastraEdital = EditalCorretor::find($request->gilie);
        $cadastraEdital->edital  = $request->numeroEdital;
        $cadastraEdital->save();
      
      $request->session()->flash('corMensagem', 'success');
      $request->session()->flash('tituloMensagem', "Alteração realizada!");
      $request->session()->flash('corpoMensagem', "O cadastro do Edital foi alterado com sucesso.");

    DB::commit();
      } catch (\Throwable $th) {
          if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
          } else {
              AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
          }
          DB::rollback();
          // RETORNA A FLASH MESSAGE
          $request->session()->flash('corMensagem', 'danger');
          $request->session()->flash('tituloMensagem', "Edição não efetuada");
          $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a edição dos dados. Tente novamente");
      }
      return back();

    }

    public function listaCorretoresCredenciamento()
    {
        $corretores= DB::table('TBL_CORRETORES_CADASTRAMENTO')
        ->select(DB::raw("
        [idProcesso] as processo
        ,[credenciado]
        ,[CNPJ]
        ,[CPF]
        ,[Representante]
        ,[numeroContrato]
        ,ISNULL([numeroContrato], 'Sem Contrato') as numeroContrato
        ,[dataConvoc]
        ,ISNULL([contratoDevolvido], '') as contratoDevolvido
        ,[endereço]
        ,[email]
        ,[obs]
        ,ISNULL([SICAF], '') as SICAF
      "))
        ->get();

         return json_encode($corretores);
        
    }
  
    public function adicionaCorretorTabelaCredenciamento(Request $request)
    {
      try {
        DB::beginTransaction();
        $confereCNPJ = null;
        $confereCPF = null;
        if (isset($request->CNPJ)) {
          $confereCNPJ = DB::table('TBL_CORRETORES_CADASTRAMENTO')->where('CNPJ', $request->CNPJ)->first();
        }
        if (isset($request->CPF)) {
        $confereCPF = DB::table('TBL_CORRETORES_CADASTRAMENTO')->where('CPF', $request->CPF)->first();
        }

      if ($confereCNPJ || $confereCPF != null){
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Inclusão não efetuada");
            $request->session()->flash('corpoMensagem', "Já existe CNPJ/CPF cadastrado");
      }else{

      $atualizaCorretor = new CorretorCadastramento;
      $atualizaCorretor->credenciado = $request->nomeCredenciado;
      $atualizaCorretor->CNPJ = $request->CNPJ;
      $atualizaCorretor->CPF = $request->CPF;
      $atualizaCorretor->Representante = $request->nomeRepresentante;
      $atualizaCorretor->email = $request->email;
      $atualizaCorretor->matriculaCadastro = session('matricula');
      $atualizaCorretor->save();

      $mensagemCECOT = file_get_contents(("emailAvisoCECOTnovo.php"), dirname(__FILE__));

      $mailCecot = new PHPMailer(true);
      $mailCecot->isSMTP();
      $mailCecot->CharSet = 'UTF-8'; 
      $mailCecot->isHTML(true);                                         
      $mailCecot->Host = 'sistemas.correiolivre.caixa';  
      $mailCecot->SMTPAuth = false;                                  
      $mailCecot->Port = 25;
      // $mail->SMTPDebug = 2;
      $mailCecot->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
      $mailCecot->addReplyTo('GILIESP01@caixa.gov.br');
      if (env('APP_ENV') == 'PRODUCAO'){
        $mailCecot->addBCC('c142639@caixa.gov.br');
        $mailCecot->addBCC('c098453@caixa.gov.br');
      }else{
          $mailCecot->addAddress('c098453@mail.caixa');
          $mailCecot->addBCC('c142639@caixa.gov.br');
      }
      $mailCecot->Subject = 'Solicitação de efetivação de contratação';
      $mailCecot->Body = $mensagemCECOT;
      $mailCecot->send();
      
      $mensagemCorretor = file_get_contents(("emailInclusaoAnaliseCECOT.php"), dirname(__FILE__));
      $mensagemCorretor = str_replace("%CREDENCIADO%", $request->nomeCredenciado, $mensagemCorretor);
      
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->CharSet = 'UTF-8'; 
      $mail->isHTML(true);                                         
      $mail->Host = 'sistemas.correiolivre.caixa';  
      $mail->SMTPAuth = false;                                  
      $mail->Port = 25;
      // $mail->SMTPDebug = 2;
      $mail->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
      $mail->addReplyTo('GILIESP01@caixa.gov.br');
      if (env('APP_ENV') == 'PRODUCAO'){
        // $mail->addAddress($request->email);
        $mail->addCC( session('matricula') . '@mail.caixa');
        $mail->addBCC('GILIESP09@caixa.gov.br');
        $mail->addBCC('c142639@caixa.gov.br');
        $mail->addBCC('c098453@caixa.gov.br');
      }else{
          $mail->addAddress('c098453@mail.caixa');  
      }
      $mail->Subject = 'Orientações para efetivação de contratação - Credenciamento de corretores e imobiliárias';
      $mail->Body = $mensagemCorretor;
      $mail->send();


      $request->session()->flash('corMensagem', 'success');
      $request->session()->flash('tituloMensagem', "inclusão realizada!");
      $request->session()->flash('corpoMensagem', "A inclusão do corretor foi efetuada com sucesso.");
    }
    DB::commit();
      } catch (\Throwable $th) {
          if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
          } else {
              AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
          }
          DB::rollback();
          // RETORNA A FLASH MESSAGE
          $request->session()->flash('corMensagem', 'danger');
          $request->session()->flash('tituloMensagem', "Inclusão não efetuada");
          $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a inclusão. Tente novamente");
      }
      return back();

    }

    public function criaPlanilhaExcelCorretoresCredenciamento()
    {
        return Excel::download(new criaExcelCorretoresCredenciamento, 'Posição_Corretores.xlsx');
    }

    public function import(Request $request) 
    {
        try {
            
            $pathtofile = ($_FILES['arquivo']['name']);
           
            $info = pathinfo($pathtofile);
            if ($info["extension"] == "xlsx" || $info["extension"] == "xls"){
            Excel::import(new corretoresCredenciamentoImport,request()->file('arquivo'));

            $mensagemGILIE = file_get_contents(("emailAvisoAlteraCredenciado.php"), dirname(__FILE__));

            $mailGILIE = new PHPMailer(true);
            $mailGILIE->isSMTP();
            $mailGILIE->CharSet = 'UTF-8'; 
            $mailGILIE->isHTML(true);                                         
            $mailGILIE->Host = 'sistemas.correiolivre.caixa';  
            $mailGILIE->SMTPAuth = false;                                  
            $mailGILIE->Port = 25;
            // $mail->SMTPDebug = 2;
            $mailGILIE->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
            $mailGILIE->addReplyTo('GILIESP01@caixa.gov.br');
            if (env('APP_ENV') == 'PRODUCAO'){
              $mailGILIE->addAddress('c098453@mail.caixa');
              $mailGILIE->addBCC('c142639@mail.caixa');
            }else{
                $mailGILIE->addAddress('c098453@mail.caixa');
                $mailGILIE->addBCC('c142639@mail.caixa');
            }
            $mailGILIE->Subject = 'Inclusão de novo Credenciamento';
            $mailGILIE->Body = $mensagemGILIE;
            $mailGILIE->send();
          
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

       public function enviaEmailPendenteSICAF($idCredenciado, Request $request)
    {

      try { 

      $mensagemPendenteSICAF = file_get_contents(("emailPendenteSICAF.php"), dirname(__FILE__));
      $mensagemPendenteSICAF = str_replace("%CREDENCIADO%", $request->nomeCredenciado, $mensagemPendenteSICAF);

      $mailPendenteSICAF = new PHPMailer(true);
      $mailPendenteSICAF->isSMTP();
      $mailPendenteSICAF->CharSet = 'UTF-8'; 
      $mailPendenteSICAF->isHTML(true);                                         
      $mailPendenteSICAF->Host = 'sistemas.correiolivre.caixa';  
      $mailPendenteSICAF->SMTPAuth = false;                                  
      $mailPendenteSICAF->Port = 25;
      // $mail->SMTPDebug = 2;
      $mailPendenteSICAF->setFrom('GILIESP09@caixa.gov.br', 'GILIESP - Rotinas Automáticas');
      $mailPendenteSICAF->addReplyTo('GILIESP01@caixa.gov.br');
      if (env('APP_ENV') == 'PRODUCAO'){
          $mailPendenteSICAF->addBCC('GILIESP09@caixa.gov.br');
          $mailPendenteSICAF->addBCC('c142639@caixa.gov.br');
          $mailPendenteSICAF->addBCC('c098453@caixa.gov.br');
      }else{
          $mailPendenteSICAF->addAddress('c098453@mail.caixa');
          $mailPendenteSICAF->addCC('c142639@mail.caixa');
      }
      $mailPendenteSICAF->Subject = 'Orientações para efetivação de contratação - Pendência SICAF';
      $mailPendenteSICAF->Body = $mensagemPendenteSICAF;
      $mailPendenteSICAF->send();

      session()->flash('corMensagem', 'success');
      session()->flash('tituloMensagem', "Mensagem enviada");
      session()->flash('corpoMensagem', "A sua mensagem foi enviada com sucesso.");

    } catch (\Throwable $th) {
      AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
      DB::rollback();
      // RETORNA A FLASH MESSAGE
      session()->flash('corMensagem', 'danger');
      session()->flash('tituloMensagem', "Algo deu errado!!!");
      session()->flash('corpoMensagem', "Tente novamente");
  }

      return back();
    }
}
