<?php

namespace App\Http\Controllers\Indicadores;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\LogAcessosPortal;
use Illuminate\Support\Facades\DB;


class indicadoresPesquisaCepat extends Controller
{
    public function indexIndicadoresPesquisaCepat()
    {
        return view('portal.gerencial.resultado-form');
    }    
}