<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Ldap;
use Illuminate\Support\Facades\DB;

class CorretoresController extends Controller
{
    public function Corretores()
    {
        return view ('portal.informativas.corretores');
        
    }
    public function listaCorretores()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $corretores= DB::table('TBL_CORRETORES')
        ->where('GILIE', $codigoUnidadeUsuarioSessao)
        ->get();

         return json_encode($corretores);
        
    }

}