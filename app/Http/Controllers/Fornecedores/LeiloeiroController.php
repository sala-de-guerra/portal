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
            $novoLeiloeiro->classificacaoImoveisLeilao          = $request->classificacaoImoveisLeilao;
            $novoLeiloeiro->quantidadeLeiloesRealizados         = $request->quantidadeLeiloesRealizados;
            $novoLeiloeiro->nomeLeiloeiro                       = mb_convert_case($request->nomeLeiloeiro, MB_CASE_UPPER, 'UTF-8');
            $novoLeiloeiro->telefoneLeiloeiro                   = $request->telefoneLeiloeiro;
            $novoLeiloeiro->emailLeiloeiro                      = $request->emailLeiloeiro;
            $novoLeiloeiro->enderecoLeiloeiro                   = mb_convert_case($request->enderecoLeiloeiro, MB_CASE_UPPER, 'UTF-8');
            $novoLeiloeiro->nomeEmpresaAssessoraLeiloeiro       = mb_convert_case($request->nomeEmpresaAssessoraLeiloeiro, MB_CASE_UPPER, 'UTF-8');
            $novoLeiloeiro->telefoneEmpresaAssessoraLeiloeiro   = $request->telefoneEmpresaAssessoraLeiloeiro;
            $novoLeiloeiro->emailEmpresaAssessoraLeiloeiro      = $request->emailEmpresaAssessoraLeiloeiro;
            $novoLeiloeiro->siteEmpresaAssessoraLeiloeiro       = $request->siteEmpresaAssessoraLeiloeiro;
            $novoLeiloeiro->enderecoEmpresaAssessoraLeiloeiro   = mb_convert_case($request->enderecoEmpresaAssessoraLeiloeiro, MB_CASE_UPPER, 'UTF-8');
            $novoLeiloeiro->enderecoRealizacaoLeilao            = mb_convert_case($request->enderecoRealizacaoLeilao, MB_CASE_UPPER, 'UTF-8');
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
    public function editarCadastroLeiloeiro(Request $request, $idLeiloeiro)
    {
        try {
            DB::beginTransaction();
            $editarLeiloeiro = Leiloeiro::find($idLeiloeiro);
            $editarLeiloeiro->numeroContrato                    = !in_array($request->numeroContrato, [null, 'NULL', '']) ? $request->numeroContrato : $editarLeiloeiro->numeroContrato;
            $editarLeiloeiro->dataVencimentoContrato            = !in_array($request->dataVencimentoContrato, [null, 'NULL', '']) ? $request->dataVencimentoContrato : $editarLeiloeiro->dataVencimentoContrato;
            $editarLeiloeiro->classificacaoImoveisLeilao        = !in_array($request->classificacaoImoveisLeilao, [null, 'NULL', '']) ? $request->classificacaoImoveisLeilao : $editarLeiloeiro->classificacaoImoveisLeilao;
            $editarLeiloeiro->quantidadeLeiloesRealizados       = !in_array($request->quantidadeLeiloesRealizados, [null, 'NULL', '']) ? $request->quantidadeLeiloesRealizados : $editarLeiloeiro->quantidadeLeiloesRealizados;
            $editarLeiloeiro->nomeLeiloeiro                     = !in_array($request->nomeLeiloeiro, [null, 'NULL', '']) ? mb_convert_case($request->nomeLeiloeiro, MB_CASE_UPPER, 'UTF-8') : $editarLeiloeiro->nomeLeiloeiro;
            $editarLeiloeiro->telefoneLeiloeiro                 = !in_array($request->telefoneLeiloeiro, [null, 'NULL', '']) ? $request->telefoneLeiloeiro : $editarLeiloeiro->telefoneLeiloeiro;
            $editarLeiloeiro->emailLeiloeiro                    = !in_array($request->emailLeiloeiro, [null, 'NULL', '']) ? $request->emailLeiloeiro : $editarLeiloeiro->emailLeiloeiro;
            $editarLeiloeiro->enderecoLeiloeiro                 = !in_array($request->enderecoLeiloeiro, [null, 'NULL', '']) ? $request->enderecoLeiloeiro : $editarLeiloeiro->enderecoLeiloeiro;
            $editarLeiloeiro->nomeEmpresaAssessoraLeiloeiro     = !in_array($request->nomeEmpresaAssessoraLeiloeiro, [null, 'NULL', '']) ? mb_convert_case($request->nomeEmpresaAssessoraLeiloeiro, MB_CASE_UPPER, 'UTF-8') : $editarLeiloeiro->nomeEmpresaAssessoraLeiloeiro;
            $editarLeiloeiro->telefoneEmpresaAssessoraLeiloeiro = !in_array($request->telefoneEmpresaAssessoraLeiloeiro, [null, 'NULL', '']) ? $request->telefoneEmpresaAssessoraLeiloeiro : $editarLeiloeiro->telefoneEmpresaAssessoraLeiloeiro;
            $editarLeiloeiro->emailEmpresaAssessoraLeiloeiro    = !in_array($request->emailEmpresaAssessoraLeiloeiro, [null, 'NULL', '']) ? $request->emailEmpresaAssessoraLeiloeiro : $editarLeiloeiro->emailEmpresaAssessoraLeiloeiro;
            $editarLeiloeiro->siteEmpresaAssessoraLeiloeiro     = !in_array($request->siteEmpresaAssessoraLeiloeiro, [null, 'NULL', '']) ? $request->siteEmpresaAssessoraLeiloeiro : $editarLeiloeiro->siteEmpresaAssessoraLeiloeiro;
            $editarLeiloeiro->enderecoEmpresaAssessoraLeiloeiro = !in_array($request->enderecoEmpresaAssessoraLeiloeiro, [null, 'NULL', '']) ? mb_convert_case($request->enderecoEmpresaAssessoraLeiloeiro, MB_CASE_UPPER, 'UTF-8') : $editarLeiloeiro->enderecoEmpresaAssessoraLeiloeiro;
            $editarLeiloeiro->enderecoRealizacaoLeilao          = !in_array($request->enderecoRealizacaoLeilao, [null, 'NULL', '']) ? mb_convert_case($request->enderecoRealizacaoLeilao, MB_CASE_UPPER, 'UTF-8') : $editarLeiloeiro->enderecoRealizacaoLeilao;
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idLeiloeiro
     * @return \Illuminate\Http\Response
     */
    public function desativarLeiloeiro(Request $request, $idLeiloeiro)
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
