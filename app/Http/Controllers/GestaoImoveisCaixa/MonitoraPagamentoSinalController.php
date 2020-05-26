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

        $consultaContratosSemPagamentoSinal = BaseSimov::where('DATA_PROPOSTA', '<=', Carbon::now()->sub('7 day')->format('Y-m-d'))
                                                        ->where('UNA',  $siglaGilie)
                                                        ->where(function($query) {
                                                            $query->where('STATUS_IMOVEL', 'Em Contratação')
                                                                    ->orWhere('STATUS_IMOVEL', 'Contratação pendente')
                                                                    ;})
                                                        ->get();
        $listaContratosSemPagamentoSinal = [];                                              
        foreach ($consultaContratosSemPagamentoSinal as $contrato) {
            // VERIFICA SE EXISTE PAGAMENTO DO SINAL
            if($contrato->conformidadeContratacao) {
                if ($contrato->conformidadeContratacao->cardDeAgrupamento == 'GILIE') {           
                    if ($contrato->saldoContratoSinaf) {
                        if ($contrato->saldoContratoSinaf->saldoAtualContrato < $contrato->VALOR_REC_PROPRIOS_PROPOSTA) {
                            array_push($listaContratosSemPagamentoSinal, [
                                'numeroContrato' => $contrato->NU_BEM,
                                'dataProposta' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
                                'valorProposta' => $contrato->VALOR_TOTAL_PROPOSTA,
                                'vencimentoPp15' => self::calculaVencimentoPp15($contrato->DATA_PROPOSTA),
                                'statusSimov' => $contrato->STATUS_IMOVEL,
                                'classificacaoImovel' =>$contrato->CLASSIFICACAO,
                                'bemFormatado' => $contrato->BEM_FORMATADO,
                                'ValorRecebido' => $contrato->VALOR_REC_PROPRIOS_PROPOSTA,
                                'NOME_PROPONENTE' => $contrato->NOME_PROPONENTE,
                                'NO_CORRETOR' => $contrato->NO_CORRETOR,
                                'EMAIL_CORRETOR' =>$contrato->EMAIL_CORRETOR,
                                'UNA' =>$contrato->UNA
                            ]);
                        } 
                    } else {
                        array_push($listaContratosSemPagamentoSinal, [
                            'numeroContrato' => $contrato->NU_BEM,
                            'dataProposta' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
                            'valorProposta' => $contrato->VALOR_TOTAL_PROPOSTA,
                            'vencimentoPp15' => self::calculaVencimentoPp15($contrato->DATA_PROPOSTA),
                            'statusSimov' => $contrato->STATUS_IMOVEL,
                            'classificacaoImovel' =>$contrato->CLASSIFICACAO,
                            'bemFormatado' => $contrato->BEM_FORMATADO,
                            'ValorRecebido' => $contrato->VALOR_REC_PROPRIOS_PROPOSTA,
                            'NOME_PROPONENTE' => $contrato->NOME_PROPONENTE,
                            'NO_CORRETOR' => $contrato->NO_CORRETOR,
                            'EMAIL_CORRETOR' =>$contrato->EMAIL_CORRETOR,
                            'UNA' =>$contrato->UNA
                        ]);
                    }
                }
            } else {
                if ($contrato->saldoContratoSinaf) {
                    if ($contrato->saldoContratoSinaf->saldoAtualContrato < $contrato->VALOR_REC_PROPRIOS_PROPOSTA) {
                        array_push($listaContratosSemPagamentoSinal, [
                            'numeroContrato' => $contrato->NU_BEM,
                            'dataProposta' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
                            'valorProposta' => $contrato->VALOR_TOTAL_PROPOSTA,
                            'vencimentoPp15' => self::calculaVencimentoPp15($contrato->DATA_PROPOSTA),
                            'statusSimov' => $contrato->STATUS_IMOVEL,
                            'classificacaoImovel' =>$contrato->CLASSIFICACAO,
                            'bemFormatado' => $contrato->BEM_FORMATADO,
                            'ValorRecebido' => $contrato->VALOR_REC_PROPRIOS_PROPOSTA,
                            'NOME_PROPONENTE' => $contrato->NOME_PROPONENTE,
                            'NO_CORRETOR' => $contrato->NO_CORRETOR,
                            'EMAIL_CORRETOR' =>$contrato->EMAIL_CORRETOR,
                            'UNA' =>$contrato->UNA
                        ]);
                    } 
                } else {
                    array_push($listaContratosSemPagamentoSinal, [
                        'numeroContrato' => $contrato->NU_BEM,
                        'dataProposta' => Carbon::parse($contrato->DATA_PROPOSTA)->format('Y-m-d'),
                        'valorProposta' => $contrato->VALOR_TOTAL_PROPOSTA,
                        'vencimentoPp15' => self::calculaVencimentoPp15($contrato->DATA_PROPOSTA),
                        'statusSimov' => $contrato->STATUS_IMOVEL,
                        'classificacaoImovel' =>$contrato->CLASSIFICACAO,
                        'bemFormatado' => $contrato->BEM_FORMATADO,
                        'ValorRecebido' => $contrato->VALOR_REC_PROPRIOS_PROPOSTA,
                        'NOME_PROPONENTE' => $contrato->NOME_PROPONENTE,
                        'NO_CORRETOR' => $contrato->NO_CORRETOR,
                        'EMAIL_CORRETOR' =>$contrato->EMAIL_CORRETOR,
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
