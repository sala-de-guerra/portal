<?php

namespace App\Http\Controllers\Indicadores;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\LogAcessosPortal;
use Illuminate\Support\Facades\DB;


class indicadoresAtende extends Controller
{
    public function indexIndicadoresAtende()
    {
        return view('portal.atende.atende-indicadores');
    }

}
