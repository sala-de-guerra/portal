<?php

namespace App\Http\Controllers\Fornecedores;

use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\Fornecedores\Leiloeiro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeiloeiroController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarLeiloeiro(Request $request)
    {
         // dd($request);
         try {
            DB::beginTransaction();
            $novoLeiloeiro = new Leiloeiro;

            $novoLeiloeiro->dataCadastro                              = date("Y-m-d H:i:s", time());
            $novoLeiloeiro->dataAlteracao                             = date("Y-m-d H:i:s", time());
            $novoLeiloeiro->save();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
        }
        return redirect('/fornecedores/controle-leiloeiro');
    }

    /**
     * 
     * @param  int  $codigoUnidade
     * @return \Illuminate\Http\Response
     * 
     */
    public function listarLeiloeiros($codigoUnidade)
    {
        return Leiloeiro::where('leiloeiroAtivo', true)->where('unidadeGestora', $codigoUnidade)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     *
     * @param  int  $idLeiloeiro
     * @return \Illuminate\Http\Response
     */
    public function desativarLeiloeiro($idLeiloeiro)
    {
        try {
            DB::beginTransaction();
            $desativarLeiloeiro = Leiloeiro::find($idLeiloeiro);
            $desativarLeiloeiro->leiloeiroAtivo = false;
            $desativarLeiloeiro->dataAlteracao  = date("Y-m-d H:i:s", time());
            $desativarLeiloeiro->save();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
        }
        return redirect('/fornecedores/controle-leiloeiros');
    }
}
