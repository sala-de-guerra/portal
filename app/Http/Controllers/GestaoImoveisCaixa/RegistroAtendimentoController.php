<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoricoPortalGilie;
use Illuminate\Support\Facades\DB;

class RegistroAtendimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $numeroContratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function registrarHistorico(Request $request, $numeroContratoFormatado)
    {        
        try {
            DB::beginTransaction();

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $numeroContratoFormatado;
            $historico->tipo = $request->tipoAtendimento;
            $historico->atividade = $request->atividadeAtendimento;
            $historico->observacao = $request->observacaoAtendimento;
            $historico->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Histórico registrado!");
            $request->session()->flash('corpoMensagem', "O seu registro de histórico foi cadastrado com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Histórico não registrado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro do histórico. Tente novamente");
        }
        return redirect("/consulta-bem-imovel/" . $numeroContratoFormatado);
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
}