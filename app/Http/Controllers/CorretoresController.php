<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Ldap;
use Illuminate\Support\Facades\DB;
use App\Exports\criaExcelCorretores;
use App\TabelaImportExcel;
use Maatwebsite\Excel\Facades\Excel;

class CorretoresController extends Controller
{
    public function Corretores()
    {
        return view ('portal.informativas.corretores');
        
    }
    public function listaCorretores()
    {
        $date = date('Y-m-d');
        $corretores= DB::table('TBL_CORRETORES')
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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
        ->select(DB::raw("
        TBL_CORRETORES.[NO_CORRETOR] as CORRETOR,
        nullif(TBL_CORRETORES.[NU_CRECI], 'Null') as CRECI,
        nullif(TBL_CORRETORES.[CO_DDD_CELULAR], 'Null') as DDDCELULAR,
        nullif(TBL_CORRETORES.[CO_TELEFONE_CELULAR], 'Null') as TELEFONECELULAR,
        nullif(TBL_CORRETORES.[ED_EMAIL_PESSOA], 'Null') as EMAIL,
        CONVERT(varchar(25), TBL_CORRETORES.[DT_VENCIMENTO_CONTRATO], 103) as VENCIMENTO ,
        TBL_CORRETORES.[GILIE] as GILIE
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

}