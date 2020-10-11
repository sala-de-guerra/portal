<?php

namespace App\Http\Controllers\upload;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\HistoricoPortalGilie;


class uploadController extends Controller
{
    public function store (Request $request)
    {
        if ($request->file('arquivoTeste')->isValid()){
           $nameFile = "teste" . $request->file('arquivoTeste')->getClientOriginalName();
            dd($request->file('arquivoTeste')->storeAS('teste', $nameFile));
        }
    }
      
}