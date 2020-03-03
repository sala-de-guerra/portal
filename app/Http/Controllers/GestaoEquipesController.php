<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empregado;
use App\Models\GestaoEquipesEmpregados;
use App\Models\GestaoEquipesCelulas;
use App\Models\GestaoEquipesAlocarEmpregado;
use Illuminate\Support\Facades\DB;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;

class GestaoEquipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* 
            VALIDA O CODIGO DA FUNÇÃO DO EMPREGADO DA SESSÃO SE É GERENTE
            CASO POSITIVO VERIFICA SE EXISTE ALGUMA EQUIPE EXISTENTE NA UNIDADE OU 
            CASO NEGATIVO CRIA A PRIMEIRA PARA GESTÃO DO GESTOR
        */
        $usuarioGestor = Empregado::find(session('matricula'));

        if($usuarioGestor->codigoFuncao == '2066') {
            $quantidadeEquipes = GestaoEquipesCelulas::where('codigoUnidadeEquipe', $usuarioGestor->codigoLotacaoAdministrativa)->get();
            if ($quantidadeEquipes->count() == 0) {
                $primeiraEquipeUnidade = new GestaoEquipesCelulas;
                $primeiraEquipeUnidade->codigoUnidadeEquipe = $usuarioGestor->codigoLotacaoAdministrativa;
                $primeiraEquipeUnidade->nomeEquipe = 'Gerencial';
                $primeiraEquipeUnidade->matriculaGestor = $usuarioGestor->matricula;
                $primeiraEquipeUnidade->nomeGestor = $usuarioGestor->nomeCompleto;
                $primeiraEquipeUnidade->created_at = date("Y-m-d H:i:s", time());
                $primeiraEquipeUnidade->updated_at = date("Y-m-d H:i:s", time());
                $primeiraEquipeUnidade->save();
            }
        }
        return view('portal.gerencial.equipes');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function listarEquipesUnidade()
    {
        $relacaoEquipesUnidade = GestaoEquipesCelulas::where('codigoUnidadeEquipe', session('codigoLotacaoAdministrativa'))->get();
        return json_encode($relacaoEquipesUnidade);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function listarEmpregadosUnidade()
    {
        $relacaoEmpregadosUnidade = GestaoEquipesEmpregados::where('codigoUnidadeLotacao', session('codigoLotacaoAdministrativa'))->get();
        return json_encode($relacaoEmpregadosUnidade);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function alocarEmpregadoEquipe(Request $request)
    {
        try {
            DB::beginTransaction();


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
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
