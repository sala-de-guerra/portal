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
        return view('portal.fornecedores.leiloeiro');
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
            $novoLeiloeiro->numeroContrato                      = $request->numeroContrato;
            $novoLeiloeiro->dataVencimentoContrato              = $request->dataVencimentoContrato;
            $novoLeiloeiro->nomeLeiloeiro                       = $request->nomeLeiloeiro;
            $novoLeiloeiro->telefoneLeiloeiro                   = $request->telefoneLeiloeiro;
            $novoLeiloeiro->emailLeiloeiro                      = $request->emailLeiloeiro;
            $novoLeiloeiro->enderecoLeiloeiro                   = $request->enderecoLeiloeiro;
            $novoLeiloeiro->nomeEmpresaAssessoraLeiloeiro       = $request->nomeEmpresaAssessoraLeiloeiro;
            $novoLeiloeiro->telefoneEmpresaAssessoraLeiloeiro   = $request->telefoneEmpresaAssessoraLeiloeiro;
            $novoLeiloeiro->emailEmpresaAssessoraLeiloeiro      = $request->emailEmpresaAssessoraLeiloeiro;
            $novoLeiloeiro->siteEmpresaAssessoraLeiloeiro       = $request->siteEmpresaAssessoraLeiloeiro;
            $novoLeiloeiro->enderecoEmpresaAssessoraLeiloeiro   = $request->enderecoEmpresaAssessoraLeiloeiro;
            $novoLeiloeiro->enderecoRealizacaoLeilao            = $request->enderecoRealizacaoLeilao;
            $novoLeiloeiro->unidadeGestora                      = !in_array(session('codigoLotacaoFisica'), [null, 'NULL']) ? session('codigoLotacaoFisica') : session('codigoLotacaoAdministrativa');
            $novoLeiloeiro->dataCadastro                        = date("Y-m-d H:i:s", time());
            $novoLeiloeiro->dataAlteracao                       = date("Y-m-d H:i:s", time());

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Leiloeiro cadastrado!");
            $request->session()->flash('corpoMensagem', "O leiloeiro foi cadastrado com sucesso.");

            $novoLeiloeiro->save();
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Leiloeiro não realizado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o cadastro. Tente novamente");
            DB::rollback();
        }
        return redirect('/fornecedores/controle-leiloeiros');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idLeiloeiro
     * @return \Illuminate\Http\Response
     */
    public function editarCadastroDespachante(Request $request, $idLeiloeiro)
    {
        try {
            DB::beginTransaction();
            $editarLeiloeiro = Leiloeiro::find($idLeiloeiro);
            $editarLeiloeiro->numeroContrato                    = !in_array($request->numeroContrato, [null, 'NULL', '']) ? $request->numeroContrato : $editarLeiloeiro->numeroContrato;
            $editarLeiloeiro->dataVencimentoContrato            = !in_array($request->dataVencimentoContrato, [null, 'NULL', '']) ? $request->dataVencimentoContrato : $editarLeiloeiro->dataVencimentoContrato;
            $editarLeiloeiro->nomeLeiloeiro                     = !in_array($request->nomeLeiloeiro, [null, 'NULL', '']) ? $request->nomeLeiloeiro : $editarLeiloeiro->nomeLeiloeiro;
            $editarLeiloeiro->telefoneLeiloeiro                 = !in_array($request->telefoneLeiloeiro, [null, 'NULL', '']) ? strtoupper($request->telefoneLeiloeiro) : $editarLeiloeiro->telefoneLeiloeiro;
            $editarLeiloeiro->emailLeiloeiro                    = !in_array($request->emailLeiloeiro, [null, 'NULL', '']) ? $request->emailLeiloeiro : $editarLeiloeiro->emailLeiloeiro;
            $editarLeiloeiro->enderecoLeiloeiro                 = !in_array($request->enderecoLeiloeiro, [null, 'NULL', '']) ? $request->enderecoLeiloeiro : $editarLeiloeiro->enderecoLeiloeiro;
            $editarLeiloeiro->nomeEmpresaAssessoraLeiloeiro     = !in_array($request->nomeEmpresaAssessoraLeiloeiro, [null, 'NULL', '']) ? strtoupper($request->nomeEmpresaAssessoraLeiloeiro) : $editarLeiloeiro->nomeEmpresaAssessoraLeiloeiro;
            $editarLeiloeiro->telefoneEmpresaAssessoraLeiloeiro = !in_array($request->telefoneEmpresaAssessoraLeiloeiro, [null, 'NULL', '']) ? $request->telefoneEmpresaAssessoraLeiloeiro : $editarLeiloeiro->telefoneEmpresaAssessoraLeiloeiro;
            $editarLeiloeiro->emailEmpresaAssessoraLeiloeiro    = !in_array($request->emailEmpresaAssessoraLeiloeiro, [null, 'NULL', '']) ? $request->emailEmpresaAssessoraLeiloeiro : $editarLeiloeiro->emailEmpresaAssessoraLeiloeiro;
            $editarLeiloeiro->siteEmpresaAssessoraLeiloeiro     = !in_array($request->siteEmpresaAssessoraLeiloeiro, [null, 'NULL', '']) ? strtoupper($request->siteEmpresaAssessoraLeiloeiro) : $editarLeiloeiro->siteEmpresaAssessoraLeiloeiro;
            $editarLeiloeiro->enderecoEmpresaAssessoraLeiloeiro = !in_array($request->enderecoEmpresaAssessoraLeiloeiro, [null, 'NULL', '']) ? $request->enderecoEmpresaAssessoraLeiloeiro : $editarLeiloeiro->enderecoEmpresaAssessoraLeiloeiro;
            $editarLeiloeiro->enderecoRealizacaoLeilao          = !in_array($request->enderecoRealizacaoLeilao, [null, 'NULL', '']) ? $request->enderecoRealizacaoLeilao : $editarLeiloeiro->enderecoRealizacaoLeilao;
            $editarLeiloeiro->dataAlteracao                     = date("Y-m-d H:i:s", time());

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Cadastro editado!");
            $request->session()->flash('corpoMensagem', "O cadastro foi editado com sucesso.");

            $editarLeiloeiro->save();
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Edição não realizada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a edição do cadastro. Tente novamente");
            DB::rollback();
        }
        return redirect('/fornecedores/controle-leiloeiros');
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

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Leiloeiro excluído!");
            $request->session()->flash('corpoMensagem', "O leiloeiro foi removido com sucesso.");

            $desativarLeiloeiro->save();
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Exclusão não realizada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a exclusão do leiloeiro. Tente novamente");

            DB::rollback();
        }
        return redirect('/fornecedores/controle-leiloeiros');
    }
}
