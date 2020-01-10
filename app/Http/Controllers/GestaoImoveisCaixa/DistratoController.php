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
            $dadosProposta = PropostasSimov::where('NÚMERO BEM', $request->contratoFormatado)->where('NOME PROPONENTE', $request->nomeProponente)->first();
            $dadosSimov = BaseSimov::where('BEM_FORMATADO', $request->contratoFormatado)->first();
            
            // VALIDA SE EXISTE PROPOSTA CADASTRADA NA BASE DE DADOS DA GEIPT E VERIFICA SE EXISTE TELEFONE E E-MAIL
            if ( $dadosProposta == null || $dadosProposta == 'NULL') {
                $telefone = 'telefone não cadastrado';
                $emailProponente = 'e-mail não cadastrado';
            } else {
                if ($dadosProposta->{'DDD PROPONENTE'} == null || $dadosProposta->{'DDD PROPONENTE'} == 'NULL') {
                    $telefone = 'telefone não cadastrado';
                } else {
                    $telefone = "(" . $dadosProposta->{'DDD PROPONENTE'} . ") " . $dadosProposta->{'TELEFONE PROPONENTE'};
                }
                if ($dadosProposta->{'E-MAIL PROPONENTE'} == null || $dadosProposta->{'E-MAIL PROPONENTE'} == 'NULL') {
                    $emailProponente = 'e-mail não cadastrado';
                } else {
                    $emailProponente = $dadosProposta->{'E-MAIL PROPONENTE'};
                }
            }
            
            $novoDistrato = new Distrato;
            $novoDistrato->contratoFormatado = $request->contratoFormatado;
            $novoDistrato->nomeProponente = strtoupper ($request->nomeProponente);
            $novoDistrato->cpfCnpjProponente = $request->cpfCnpjProponente;
            $novoDistrato->statusAnaliseDistrato = 'CADASTRADA';
            $novoDistrato->motivoDistrato = $request->motivoDistrato;
            $novoDistrato->telefoneProponente = $telefone;
            $novoDistrato->emailProponente = $emailProponente;
            $novoDistrato->tipoVendaProposta = $dadosSimov->TIPO_VENDA;
            $novoDistrato->demandaAtiva = 'SIM';
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
            // dd($th);
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
     * @param  string  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function edit($contratoFormatado)
    {
        return view('portal.imoveis.distrato.operacional-distrato')->with('numeroContrato', $contratoFormatado);
    }

    /**
     * Apresenta json com dados do distrato para view de ação dos distratos
     *
     * @param  int  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function jsonDadosDemandaDistrato($contratoFormatado)
    {
        $demandaDistrato = Distrato::where('contratoFormatado', $contratoFormatado)->get();

        $arrayGrupoDemandasDistrato = [];
        
        // PASSA POR TODAS AS SOLICITAÇÕES DE DISTRATO DO CONTRATO (CASO HAJA MAIS DE UM CASO)
        foreach ($demandaDistrato as $demanda) {

            // VALIDA A DATA ANTES DE ATRIBUIR NO ARRAY
            if ($demanda->created_at == null || $demanda->created_at == 'NULL') {
                $dataCadastro = null;
                $dataUltimaAlteracao = null;
            } else {
                $dataCadastro = $demanda->created_at->format('yy-m-d h:i:s');
                $dataUltimaAlteracao = $demanda->updated_at->format('yy-m-d h:i:s');
            }
            
            // MONTA O ARRAY DA DEMANDA COM SOMENTE OS CAMPOS NECESSÁRIOS PARA A VIEW
            $arrayDemanda = [
                'idDistrato' => $demanda->idDistrato,
                'nomeProponente' => $demanda->nomeProponente,
                'cpfCnpjProponente' => $demanda->cpfCnpjProponente,
                'telefoneProponente' => $demanda->telefoneProponente,
                'emailProponente' => $demanda->emailProponente,
                'modalidadeProposta' => $demanda->tipoVendaProposta,
                'dataCadastro' => $dataCadastro,
                'dataUltimaAlteracaoDemanda' => $dataUltimaAlteracao,
                'motivoDistrato' => $demanda->motivoDistrato,
                'statusAnaliseDistrato' => $demanda->statusAnaliseDistrato,
                'observacaoDistrato' => $demanda->observacaoDistrato,
            ];

            // AGRUPA TODAS AS DEMANDAS EM UM ÚNICO ARRAY
            array_push($arrayGrupoDemandasDistrato, $arrayDemanda);
        }
        return json_encode($arrayGrupoDemandasDistrato);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $demandaDistrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idDistrato)
    {       
        try {
            DB::beginTransaction();
            // ATUALIZA DEMANDA
            $demandaDistrato = Distrato::find($idDistrato);
            $demandaDistrato->motivoDistrato = $request->input('motivoDistrato');
            $demandaDistrato->statusAnaliseDistrato = $request->input('statusAnaliseDistrato');
            $demandaDistrato->observacaoDistrato = $request->input('observacaoDistrato');
            $demandaDistrato->matriculaAnalista = session('matricula');
            $demandaDistrato->save();

            // CADASTRA HISTÓRICO
            $historico = new HistoricoPortalGilie;
            $historico->matricula = session('matricula');
            $historico->numeroContrato = $demandaDistrato->contratoFormatado;
            $historico->tipo = "ANALISE - STATUS: $request->statusAnaliseDistrato";
            $historico->atividade = "DISTRATO";
            $historico->observacao = $request->observacaoDistrato;
            $historico->save();

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Demanda analisada!");
            $request->session()->flash('corpoMensagem', "A demanda #" . str_pad($demandaDistrato->idDistrato, 4, '0', STR_PAD_LEFT) . " foi analisada com sucesso.");

            DB::commit();
        } catch (\Throwable $th) {
            // dd($th);
            DB::rollback();
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Análise não efetuada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o registro da análise. Tente novamente");
        }
        return redirect("/estoque-imoveis/distrato/tratar/" . $demandaDistrato->contratoFormatado);
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
