<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestaoEquipesAtividades;
use App\Models\GestaoEquipesAtividadesResponsaveis;
use App\Models\GestaoEquipesCelulas;

class GestaoEquipesAtividadesController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.gerencial.atividades');
    }

    /**
     * 
     * @return \Illuminate\Http\Response
     */
    public function listarAtividadesComResponsaveis($codigoUnidade)
    {
       
        $arrayEquipesComAtividadesResponsaveis = [];
        $equipesUnidade = GestaoEquipesCelulas::where('codigoUnidadeEquipe', $codigoUnidade)->where('ativa', true)->get();
        foreach ($equipesUnidade as $equipe) {
            $arrayAtividadesEquipe = [];
            if ($equipe->GestaoEquipesAtividades->count() > 0) {
                foreach ($equipe->GestaoEquipesAtividades as $atividade) {
                    if ($atividade->atividadeSubordinada) {
                        # code...
                    } else {
                        # code...
                    }
                }
            }
        }
        
        return json_encode($equipesUnidade);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public static function incluirEmpregadoNoArrayDaEquipe($arrayEmpregadosEquipe, $objetoGestaoEquipesEmpregados) {
        $nomeCompleto = is_null($objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeCompleto) ? '' : ucwords(strtolower((string) $objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeCompleto));
        array_push($arrayEmpregadosEquipe, [
            'matricula'     => $objetoGestaoEquipesEmpregados->matricula,
            // 'nomeCompleto'  => $nomeCompleto,
            // 'nomeFuncao'    => is_null($objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeFuncao) ? 'TECNICO BANCARIO NOVO' : $objetoGestaoEquipesEmpregados->dadosEmpregadoLdap->nomeFuncao,
        ]);
        return $arrayEmpregadosEquipe;
    }
}
