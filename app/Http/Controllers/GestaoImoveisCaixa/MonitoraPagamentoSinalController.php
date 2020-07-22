<?php

namespace App\Http\Controllers\GestaoImoveisCaixa;

use App\Classes\Ldap;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use App\Models\GestaoImoveisCaixa\PainelDeVendasGeipt;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MonitoraPagamentoSinalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.imoveis.contratacao.monitora-pagamento-sinal');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarContratosSemPagamentoSinal()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);

        $consultaContratosSemPagamentoSinal = BaseSimov::where('ALITB001_Imovel_Completo.DATA_PROPOSTA', '<=', Carbon::now()->sub('7 day')->format('Y-m-d'))
                                            ->leftjoin('TBL_HISTORICO_PORTAL_GILIE', 'TBL_HISTORICO_PORTAL_GILIE.numeroContrato',  "=", 'ALITB001_Imovel_Completo.BEM_FORMATADO')
                                            ->leftjoin('ALITB048_CUB120000', 'ALITB048_CUB120000.NOME PROPONENTE',  "=", 'ALITB001_Imovel_Completo.NOME_PROPONENTE')
                                                     ->select(DB::raw('
                                                        ALITB001_Imovel_Completo.[NU_BEM] as NU_BEM,
                                                        ALITB001_Imovel_Completo.[UNA] as UNA,
                                                        ALITB001_Imovel_Completo.[DATA_PROPOSTA] as DATA_PROPOSTA, 
                                                        ALITB001_Imovel_Completo.[STATUS_IMOVEL] as STATUS_IMOVEL,
                                                        ALITB001_Imovel_Completo.[VALOR_TOTAL_PROPOSTA] as VALOR_TOTAL_PROPOSTA,
                                                        ALITB001_Imovel_Completo.[CLASSIFICACAO] as CLASSIFICACAO,
                                                        ALITB001_Imovel_Completo.[BEM_FORMATADO] as BEM_FORMATADO,
                                                        ALITB001_Imovel_Completo.[VALOR_REC_PROPRIOS_PROPOSTA] as VALOR_REC_PROPRIOS_PROPOSTA,
                                                        ALITB001_Imovel_Completo.[NOME_PROPONENTE] as NOME_PROPONENTE,
                                                        ALITB048_CUB120000.[E-MAIL PROPONENTE] as emailproponente,
                                                        ALITB048_CUB120000.[NOME PROPONENTE] as nomeproponente,
                                                        ALITB001_Imovel_Completo.[NO_CORRETOR] as NO_CORRETOR,
                                                        ALITB001_Imovel_Completo.[EMAIL_CORRETOR] as EMAIL_CORRETOR,
                                                        TBL_HISTORICO_PORTAL_GILIE.[updated_at] as updated_at,
                                                        TBL_HISTORICO_PORTAL_GILIE.[observacao] as observacao,
                                                        TBL_HISTORICO_PORTAL_GILIE.[atividade] as atividade
                                                    '))
                                                        ->where('UNA',  $siglaGilie)
                                                        ->where(function($query) {
                                                            $query->where('STATUS_IMOVEL', 'Em Contratação')
                                                                    ->orWhere('STATUS_IMOVEL', 'Contratação pendente')
                                                                    ;})
                                                        ->orderBy('updated_at', 'desc')
                                                        ->get();
        
        $retiraDuplicado = $consultaContratosSemPagamentoSinal->unique('NU_BEM');
        
        $listaContratosSemPagamentoSinal = [];                                             
        foreach ($retiraDuplicado as $contrato) {
            // VERIFICA SE EXISTE PAGAMENTO DO SINAL
            if($contrato->conformidadeContratacao) {
                if ($contrato->conformidadeContratacao->cardDeAgrupamento == 'GILIE') {           
                    if ($contrato->saldoContratoSinaf) {
                        if ($contrato->saldoContratoSinaf->saldoAtualContrato < $contrato->VALOR_REC_PROPRIOS_PROPOSTA) {
                            array_push($listaContratosSemPagamentoSinal, [
                                'NU_BEM' => $contrato->NU_BEM,
                                'DATA_PROPOSTA' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
                                'VALOR_TOTAL_PROPOSTA' => $contrato->VALOR_TOTAL_PROPOSTA,
                                'vencimentoPp15' => self::calculaVencimentoPp15($contrato->DATA_PROPOSTA),
                                'STATUS_IMOVEL' => $contrato->STATUS_IMOVEL,
                                'CLASSIFICACAO' =>$contrato->CLASSIFICACAO,
                                'BEM_FORMATADO' => $contrato->BEM_FORMATADO,
                                'VALOR_REC_PROPRIOS_PROPOSTA' => $contrato->VALOR_REC_PROPRIOS_PROPOSTA,
                                'NOME_PROPONENTE' => $contrato->NOME_PROPONENTE,
                                'emailproponente' => $contrato->emailproponente,
                                'NO_CORRETOR' => $contrato->NO_CORRETOR,
                                'EMAIL_CORRETOR' =>$contrato->EMAIL_CORRETOR,
                                'updated_at' =>$contrato->updated_at,
                                'atividade' =>$contrato->atividade,
                                'observacao' =>$contrato->observacao,
                                'UNA' =>$contrato->UNA
                            ]);
                        } 
                    } else {
                        array_push($listaContratosSemPagamentoSinal, [
                            'NU_BEM' => $contrato->NU_BEM,
                            'DATA_PROPOSTA' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
                            'VALOR_TOTAL_PROPOSTA' => $contrato->VALOR_TOTAL_PROPOSTA,
                            'vencimentoPp15' => self::calculaVencimentoPp15($contrato->DATA_PROPOSTA),
                            'STATUS_IMOVEL' => $contrato->STATUS_IMOVEL,
                            'CLASSIFICACAO' =>$contrato->CLASSIFICACAO,
                            'BEM_FORMATADO' => $contrato->BEM_FORMATADO,
                            'VALOR_REC_PROPRIOS_PROPOSTA' => $contrato->VALOR_REC_PROPRIOS_PROPOSTA,
                            'NOME_PROPONENTE' => $contrato->NOME_PROPONENTE,
                            'emailproponente' => $contrato->emailproponente,
                            'NO_CORRETOR' => $contrato->NO_CORRETOR,
                            'EMAIL_CORRETOR' =>$contrato->EMAIL_CORRETOR,
                            'updated_at' =>$contrato->updated_at,
                            'atividade' =>$contrato->atividade,
                            'observacao' =>$contrato->observacao,
                            'UNA' =>$contrato->UNA
                        ]);
                    }
                }
            } else {
                if ($contrato->saldoContratoSinaf) {
                    if ($contrato->saldoContratoSinaf->saldoAtualContrato < $contrato->VALOR_REC_PROPRIOS_PROPOSTA) {
                        array_push($listaContratosSemPagamentoSinal, [
                            'NU_BEM' => $contrato->NU_BEM,
                            'DATA_PROPOSTA' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
                            'VALOR_TOTAL_PROPOSTA' => $contrato->VALOR_TOTAL_PROPOSTA,
                            'vencimentoPp15' => self::calculaVencimentoPp15($contrato->DATA_PROPOSTA),
                            'STATUS_IMOVEL' => $contrato->STATUS_IMOVEL,
                            'CLASSIFICACAO' =>$contrato->CLASSIFICACAO,
                            'BEM_FORMATADO' => $contrato->BEM_FORMATADO,
                            'VALOR_REC_PROPRIOS_PROPOSTA' => $contrato->VALOR_REC_PROPRIOS_PROPOSTA,
                            'NOME_PROPONENTE' => $contrato->NOME_PROPONENTE,
                            'emailproponente' => $contrato->emailproponente,
                            'NO_CORRETOR' => $contrato->NO_CORRETOR,
                            'EMAIL_CORRETOR' =>$contrato->EMAIL_CORRETOR,
                            'updated_at' =>$contrato->updated_at,
                            'atividade' =>$contrato->atividade,
                            'observacao' =>$contrato->observacao,
                            'UNA' =>$contrato->UNA
                        ]);
                    } 
                } else {
                    array_push($listaContratosSemPagamentoSinal, [
                        'NU_BEM' => $contrato->NU_BEM,
                        'DATA_PROPOSTA' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
                        'VALOR_TOTAL_PROPOSTA' => $contrato->VALOR_TOTAL_PROPOSTA,
                        'vencimentoPp15' => self::calculaVencimentoPp15($contrato->DATA_PROPOSTA),
                        'STATUS_IMOVEL' => $contrato->STATUS_IMOVEL,
                        'CLASSIFICACAO' =>$contrato->CLASSIFICACAO,
                        'BEM_FORMATADO' => $contrato->BEM_FORMATADO,
                        'VALOR_REC_PROPRIOS_PROPOSTA' => $contrato->VALOR_REC_PROPRIOS_PROPOSTA,
                        'NOME_PROPONENTE' => $contrato->NOME_PROPONENTE,
                        'emailproponente' => $contrato->emailproponente,
                        'NO_CORRETOR' => $contrato->NO_CORRETOR,
                        'EMAIL_CORRETOR' =>$contrato->EMAIL_CORRETOR,
                        'updated_at' =>$contrato->updated_at,
                        'atividade' =>$contrato->atividade,
                        'observacao' =>$contrato->observacao,
                        'UNA' =>$contrato->UNA
                    ]);
                }
            }
        }
        return json_encode($listaContratosSemPagamentoSinal);
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

    public static function calculaVencimentoPp15($dataProposta) 
    {
        $dataProposta = Carbon::parse($dataProposta);
        $diasUteis = 0;

        $feriados = array(
            'dia-mundial-da-paz' => '01-01',
            'terca-carnaval' => '= easter -47',
            'segunda-carnaval' => '= easter -48',
            'sexta-feira-da-paixao' => '= easter -2',
            'tirandentes' => '04-21',
            'trabalho' => '05-01',
            'corpus-christi' => '= easter 60',
            'independencia-do-brasil' => '09-07',
            'nossa-sra-aparecida' => '10-12',
            'finados' => '11-02',
            'proclamacao-republica' => '11-15',
            'natal' => '12-25',
            'ultimo-dia-util' => '12-31',
        );
        
        BusinessDay::enable('Illuminate\Support\Carbon', 'br-national', $feriados);
        Carbon::setHolidaysRegion('br-national');
        while ($diasUteis < 5) {
            $dataProposta->addDay();
            if (!$dataProposta->isBusinessDay()) {
                $dataProposta = $dataProposta->nextBusinessDay();
            }
            $diasUteis++;
        }
        return $dataProposta->format('Y-m-d');
    }
}
