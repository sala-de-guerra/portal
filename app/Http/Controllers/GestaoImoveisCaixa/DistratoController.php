<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GestaoImoveisCaixa\Distrato;
use App\Models\HistoricoPortalGilie;
use App\Models\BaseSimov;
use App\Models\PropostasSimov;

class DistratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        return view('portal.imoveis.distrato.controle-distrato');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $dadosProposta = PropostasSimov::where('BEM_FORMATADO', $request->contratoFormatado)->get();

            $novoDistrato = new Distrato;
            $novoDistrato->contratoFormatado = $request->contratoFormatado;
            $novoDistrato->nomeProponente = $request->nomeProponente;
            $novoDistrato->cpfCnpjProponente = $request->cpfCnpjProponente;
            $novoDistrato->statusAnaliseDistrato = 'INICIAR ANÁLISE';
            $novoDistrato->motivoDistrato = $request->motivoDistrato;
            // dd($novoDistrato);
            $novoDistrato->save();

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $request->contratoFormatado;
            $historico->tipo = "CADASTRO";
            $historico->atividade = "DISTRATO";
            $historico->observacao = "CADASTRO DE DISTRATO - MOTIVO: $request->motivoDistrato - PROPONENTE: $request->nomeProponente - PROTOCOLO: #" . str_pad($novoDistrato->idDistrato, 4, '0', STR_PAD_LEFT);
            $historico->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Distrato cadastrado!");
            $request->session()->flash('corpoMensagem', "O protocolo #" . str_pad($novoDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " foi cadastrado com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Cadastro não efetuado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o cadastro da demanda. Tente novamente");
        }
        return redirect('/estoque-imoveis/distrato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $universoProtocolosDistrato = Distrato::select('idDistrato', 'contratoFormatado', 'nomeProponente', 'statusAnaliseDistrato', 'motivoDistrato', 'created_at')->get();
        return json_encode($universoProtocolosDistrato);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function edit($contratoFormatado)
    {
        return view('portal.imoveis.distrato.operacional-distrato');
    }

    /**
     * Apresenta json com dados do contrato e do distrato para view de ação dos distratos
     *
     * @param  int  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function jsonDadosSimovComDadosDistrato($contratoFormatado)
    {
        // $contrato = BaseSimov::with('distrato')->where('BEM_FORMATADO', $contratoFormatado)->first();
        $dadosProposta = PropostasSimov::where('NÚMERO BEM', $contratoFormatado)->get();
        dd($dadosProposta);
        // $arrayDadosContratoComDistrato = [
        //     'idDistrato' =>,
        //     'nomeProponente' =>,
        //     'cpfCnpjProponente' =>,
        //     'telefoneProponente' =>,
        //     'emailProponente' =>,
        //     'modalidadeProposta' =>,
        //     'dataCadastro' =>,
        //     'dataUltimaAlteracaoDemanda' =>,
        //     'motivoDistrato' =>,
        //     'statusAnaliseDistrato' =>,
        //     'observacaoDistrato' =>,
        // ];

        return json_encode($contrato);
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
