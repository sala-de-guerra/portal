<?php

namespace App\Http\Controllers\OrdemDeServico;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\HistoricoPortalGilie;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ordemDeServicoController extends Controller
{
    public function OrdemDeServicoIndex()
    {
        return view('portal.ordemDeServico.ordemDeServico');
    }

}
