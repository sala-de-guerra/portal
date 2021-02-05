<?php

namespace App\Http\Controllers\Indicadores;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\LogAcessosPortal;
use Illuminate\Support\Facades\DB;


class indicadoresDoacoesBensMoveis extends Controller
{
    public function indexIndicadoresDoacoes()
    {
        return view('portal.bens-moveis.indicadores');
    }    
}
