<?php

namespace App\Http\Controllers\LeilaoNegativo;

use App\Classes\Ldap;
use App\Classes\GestaoImoveisCaixa\AvisoErroPortalPhpMailer;
use App\Http\Controllers\Controller;
use App\Models\BaseSimov;
use App\Models\Fornecedores\Despachante;
use App\Models\Fornecedores\Leiloeiro;
use App\Models\LeilaoNegativo\LeilaoNegativo;
use App\Models\HistoricoPortalGilie;
use Cmixin\BusinessDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LeilaoNegativoController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.imoveis.leiloes.leiloes-negativos');
    }

    /**
     *
     * @param  string  $contratoFormatado
     * @return \Illuminate\Http\Response
     */
    public function viewTratarLeilaoNegativo($contratoFormatado)
    {
        return view('portal.imoveis.leiloes.operacional-leiloes')->with('contratoFormatado', $contratoFormatado);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarContratosControleLeiloesNegativos(Request $request)
    {
        try {
            DB::beginTransaction();
            $quantidadeRegistrosTabelaLeiloesNegativosContratosAntes = LeilaoNegativo::count();
            $mensagem = "<p>Quantidade de registro na tabela antes da rotina: $quantidadeRegistrosTabelaLeiloesNegativosContratosAntes</p>";
            $universoContratosParaCadastro = BaseSimov::where(function($classificacaoImovel) {
                                                            $classificacaoImovel->where('CLASSIFICACAO', '=', 'SFI - Gar.Fid.Reg.Créd.Imob')
                                                                                ->orWhere('CLASSIFICACAO', '=', 'Patrimonial - Alienação Fiduciária')
                                                                                ->orWhere('CLASSIFICACAO', '=', 'EMGEA- Alienação Fiduciária');
                                                        })->whereNull('DT_PROPRIEDADE_PLENA')
                                                        ->select('BEM_FORMATADO', 'NU_BEM', 'UNA', 'CLASSIFICACAO', 'CIDADE', 'OFICIO', 'MATRICULA', 'ENDERECO_IMOVEL', 'AGRUPAMENTO', 'STATUS_IMOVEL', 'DT_PRIMEIRO_LEILAO', 'DT_SEGUNDO_LEILAO')
                                                        ->get();
            foreach ($universoContratosParaCadastro as $contrato) {
                /*
                    REGRA DE NEGOCIO PARA DETERMINAR AS DATAS DE PREVISÃO DE RECEBIMENTO DO DOCUMENTOS DO LEILOEIRO E PREVISÃO DE ENTREGA DOCUMENTOS AO DESPACHANTE

                    PREVISÃO DE RECEBIMENTO DO DOCUMENTOS DO LEILOEIRO  = 5 DIAS ÚTEIS A PARTIR DA DATA DO SEGUNDO LEILÃO
                    PREVISÃO DE ENTREGA DOCUMENTOS AO DESPACHANTE       = 3 DIAS ÚTEIS A PARTIR DA ENTREGA DOS DOCUMENTOS PELO LEILOEIRO
                */
                $dataPrevisaoRecebimentoDocumentosLeiloeiro = self::contadorDiasUteis($contrato->DT_SEGUNDO_LEILAO, 5);
                $dataPrevisaoDisponibilizacaoDocumentosAoDespachante = self::contadorDiasUteis($dataPrevisaoRecebimentoDocumentosLeiloeiro, 3);
                $unidadeResponsavel = Ldap::defineCodigoUnidadeUsuarioSessao($contrato->UNA);

                // VALIDA SE JÁ EXISTE ESSE CONTRATO NO CONTROLE, CASO NEGATIVO ELE FAZ O INSERT
                $cadastroContratoLeilaoNegativo = LeilaoNegativo::firstOrCreate(
                    ['contratoFormatado' => $contrato->BEM_FORMATADO],
                    [
                        'contratoFormatado'                                 => $contrato->BEM_FORMATADO,
                        'numeroContrato'                                    => $contrato->NU_BEM,
                        'numeroLeilao'                                      => $contrato->AGRUPAMENTO,
                        'previsaoRecebimentoDocumentosLeiloeiro'            => $dataPrevisaoRecebimentoDocumentosLeiloeiro,
                        'previsaoDisponibilizacaoDocumentosAoDespachante'   => $dataPrevisaoDisponibilizacaoDocumentosAoDespachante,
                        'statusAverbacao'                                   => 'CADASTRADO',
                        'unidadeResponsavel'                                => $unidadeResponsavel,
                        'dataCadastro'                                      => date("Y-m-d H:i:s", time()),
                        'dataAlteracao'                                     => date("Y-m-d H:i:s", time()),
                    ]
                );
            }
            $quantidadeRegistrosTabelaLeiloesNegativosContratosDepois = LeilaoNegativo::count();
            DB::commit();
        } catch (\Throwable $th) {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'DESENVOLVIMENTO') {
                dd($th);
            } else {
                AvisoErroPortalPhpMailer::enviarMensageria($th, \Request::getRequestUri(), session('matricula'));
            }
            DB::rollback();
        }
        $mensagem .= "<p>Quantidade de registro na tabela depois da rotina: $quantidadeRegistrosTabelaLeiloesNegativosContratosDepois</p>";
        $quantidadeNovosContratos = $quantidadeRegistrosTabelaLeiloesNegativosContratosDepois - $quantidadeRegistrosTabelaLeiloesNegativosContratosAntes;
        $mensagem .= "<p>Quantidade de novos registros na tabela: $quantidadeNovosContratos</p>";
        return $mensagem;    
    }

    public static function contadorDiasUteis($data, $quantidadeDiasUteis) 
    {
        $dataProposta = Carbon::parse($data);
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
        while ($diasUteis < $quantidadeDiasUteis) {
            $dataProposta->addDay();
            if (!$dataProposta->isBusinessDay()) {
                $dataProposta = $dataProposta->nextBusinessDay();
            }
            $diasUteis++;
        }
        return $dataProposta->format('Y-m-d');
    }

    /**
     *
     * @param  int  $codigoUnidade
     * @return \Illuminate\Http\Response
     */
    public function listarContratosLeilaoNegativo($codigoUnidade)
    {
        $contratosLeilaoNegativo = LeilaoNegativo::where('unidadeResponsavel', $codigoUnidade)->select('contratoFormatado', 'numeroContrato', 'numeroLeilao', 'statusAverbacao', 'dataAlteracao')->get(); //

        return json_encode($contratosLeilaoNegativo);
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
