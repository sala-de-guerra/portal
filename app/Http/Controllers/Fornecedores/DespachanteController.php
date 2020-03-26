<?php

namespace App\Http\Controllers\Fornecedores;

use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\Fornecedores\Despachante;
use Illuminate\Http\Request;

class DespachanteController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.fornecedores.despachante');
    }

    /**
     * 
     * @param  int  $codigoUnidade
     * @return \Illuminate\Http\Response
     * 
     */
    public function listarDespachantes($codigoUnidade)
    {
        return Despachante::where('despachanteAtivo', true)->where('unidadeGestora', $codigoUnidade)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarDespachante(Request $request)
    {
        try {
            $novoDespachante = new Despachante;
            // $novoDespachante-> $request->;
            // $novoDespachante-> $request->;
            // $novoDespachante-> $request->;
            // $novoDespachante-> $request->;
            // $novoDespachante-> $request->;
            // $novoDespachante-> $request->;
            // $novoDespachante-> $request->;
            // $novoDespachante-> $request->;
            // $novoDespachante-> $request->;
            // $novoDespachante-> $request->;
            // $novoDespachante-> = date("Y-m-d H:i:s", time());
            // $novoDespachante-> = date("Y-m-d H:i:s", time());
        } catch (\Throwable $th) {
            // dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            
        }
        return redirect('/fornecedores/controle-despachantes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
