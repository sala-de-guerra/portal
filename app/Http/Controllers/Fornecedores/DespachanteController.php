<?php

namespace App\Http\Controllers\Fornecedores;

use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\Fornecedores\Despachante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarDespachante(Request $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $novoDespachante = new Despachante;
            $novoDespachante->numeroContrato                            = $request->numeroContrato;
            $novoDespachante->dataVencimentoContrato                    = $request->dataVencimentoContrato;
            $novoDespachante->cnpjDespachante                           = $request->cnpjDespachante;
            $novoDespachante->nomeDespachante                           = strtoupper($request->nomeDespachante);
            $novoDespachante->telefoneDespachante                       = $request->telefoneDespachante;
            $novoDespachante->emailDespachante                          = $request->emailDespachante;
            $novoDespachante->nomePrimeiroResponsavelDespachante        = strtoupper($request->nomePrimeiroResponsavelDespachante);
            $novoDespachante->telefonePrimeiroResponsavelDespachante    = $request->telefonePrimeiroResponsavelDespachante;
            $novoDespachante->emailPrimeiroResponsavelDespachante       = $request->emailPrimeiroResponsavelDespachante;
            $novoDespachante->nomeSegundoResponsavelDespachante         = strtoupper($request->nomeSegundoResponsavelDespachante);
            $novoDespachante->telefoneSegundoResponsavelDespachante     = $request->telefoneSegundoResponsavelDespachante;
            $novoDespachante->emailSegundoResponsavelDespachante        = $request->emailSegundoResponsavelDespachante;
            $novoDespachante->nomeTerceiroResponsavelDespachante        = strtoupper($request->nomeTerceiroResponsavelDespachante);
            $novoDespachante->telefoneTerceiroResponsavelDespachante    = $request->telefoneTerceiroResponsavelDespachante;
            $novoDespachante->emailTerceiroResponsavelDespachante       = $request->emailTerceiroResponsavelDespachante;
            $novoDespachante->unidadeGestora                            = !in_array(session('codigoLotacaoFisica'), [null, 'NULL']) ? session('codigoLotacaoFisica') : session('codigoLotacaoAdministrativa');
            $novoDespachante->dataCadastro                              = date("Y-m-d H:i:s", time());
            $novoDespachante->dataAlteracao                             = date("Y-m-d H:i:s", time());

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Despachante cadastrado!");
            $request->session()->flash('corpoMensagem', "O despachante foi cadastrado com sucesso.");

            $novoDespachante->save();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Cadastro não realizado");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante o cadastro. Tente novamente");
            DB::rollback();
        }
        return redirect('/fornecedores/controle-despachantes');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idDespachante
     * @return \Illuminate\Http\Response
     */
    public function editarCadastroDespachante(Request $request, $idDespachante)
    {
        try {
            DB::beginTransaction();
            $editarDespachante = Despachante::find($idDespachante);
            $editarDespachante->numeroContrato                          = !in_array($request->numeroContrato, [null, 'NULL', '']) ? $request->numeroContrato : $editarDespachante->numeroContrato;
            $editarDespachante->dataVencimentoContrato                  = !in_array($request->dataVencimentoContrato, [null, 'NULL', '']) ? $request->dataVencimentoContrato : $editarDespachante->dataVencimentoContrato;
            $editarDespachante->cnpjDespachante                         = !in_array($request->cnpjDespachante, [null, 'NULL', '']) ? $request->cnpjDespachante : $editarDespachante->cnpjDespachante;
            $editarDespachante->nomeDespachante                         = !in_array($request->nomeDespachante, [null, 'NULL', '']) ? strtoupper($request->nomeDespachante) : $editarDespachante->nomeDespachante;
            $editarDespachante->telefoneDespachante                     = !in_array($request->telefoneDespachante, [null, 'NULL', '']) ? $request->telefoneDespachante : $editarDespachante->telefoneDespachante;
            $editarDespachante->emailDespachante                        = !in_array($request->emailDespachante, [null, 'NULL', '']) ? $request->emailDespachante : $editarDespachante->emailDespachante;
            $editarDespachante->nomePrimeiroResponsavelDespachante      = !in_array($request->nomePrimeiroResponsavelDespachante, [null, 'NULL', '']) ? strtoupper($request->nomePrimeiroResponsavelDespachante) : $editarDespachante->nomePrimeiroResponsavelDespachante;
            $editarDespachante->telefonePrimeiroResponsavelDespachante  = !in_array($request->telefonePrimeiroResponsavelDespachante, [null, 'NULL', '']) ? $request->telefonePrimeiroResponsavelDespachante : $editarDespachante->telefonePrimeiroResponsavelDespachante;
            $editarDespachante->emailPrimeiroResponsavelDespachante     = !in_array($request->emailPrimeiroResponsavelDespachante, [null, 'NULL', '']) ? $request->emailPrimeiroResponsavelDespachante : $editarDespachante->emailPrimeiroResponsavelDespachante;
            $editarDespachante->nomeSegundoResponsavelDespachante       = !in_array($request->nomeSegundoResponsavelDespachante, [null, 'NULL', '']) ? strtoupper($request->nomeSegundoResponsavelDespachante) : $editarDespachante->nomeSegundoResponsavelDespachante;
            $editarDespachante->telefoneSegundoResponsavelDespachante   = !in_array($request->telefoneSegundoResponsavelDespachante, [null, 'NULL', '']) ? $request->telefoneSegundoResponsavelDespachante : $editarDespachante->telefoneSegundoResponsavelDespachante;
            $editarDespachante->emailSegundoResponsavelDespachante      = !in_array($request->emailSegundoResponsavelDespachante, [null, 'NULL', '']) ? $request->emailSegundoResponsavelDespachante : $editarDespachante->emailSegundoResponsavelDespachante;
            $editarDespachante->nomeTerceiroResponsavelDespachante      = !in_array($request->nomeTerceiroResponsavelDespachante, [null, 'NULL', '']) ? strtoupper($request->nomeTerceiroResponsavelDespachante) : $editarDespachante->nomeTerceiroResponsavelDespachante;
            $editarDespachante->telefoneTerceiroResponsavelDespachante  = !in_array($request->telefoneTerceiroResponsavelDespachante, [null, 'NULL', '']) ? $request->telefoneTerceiroResponsavelDespachante : $editarDespachante->telefoneTerceiroResponsavelDespachante;
            $editarDespachante->emailTerceiroResponsavelDespachante     = !in_array($request->emailTerceiroResponsavelDespachante, [null, 'NULL', '']) ? $request->emailTerceiroResponsavelDespachante : $editarDespachante->emailTerceiroResponsavelDespachante;
            $editarDespachante->dataAlteracao                           = date("Y-m-d H:i:s", time());

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Cadastro editado!");
            $request->session()->flash('corpoMensagem', "O cadastro do despachante foi editado com sucesso.");

            $editarDespachante->save();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Edição não realizada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a edição do cadastro. Tente novamente");
            DB::rollback();
        }
        return redirect('/fornecedores/controle-despachantes');
    }

    /**
     *
     * @param  int  $idDespachante
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function desativarDespachante(Request $request, $idDespachante)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $desativarDespachante = Despachante::find($idDespachante);
            $desativarDespachante->despachanteAtivo = false;
            $desativarDespachante->dataAlteracao    = date("Y-m-d H:i:s", time());

            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'success');
            $request->session()->flash('tituloMensagem', "Despachante excluído!");
            $request->session()->flash('corpoMensagem', "O despachante foi removido com sucesso.");

            $desativarDespachante->save();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            // RETORNA A FLASH MESSAGE
            $request->session()->flash('corMensagem', 'danger');
            $request->session()->flash('tituloMensagem', "Exclusão não realizada");
            $request->session()->flash('corpoMensagem', "Aconteceu um erro durante a exclusão do despachante. Tente novamente");
            DB::rollback();
        }
        return redirect('/fornecedores/controle-despachantes');
    }
}
