<?php

namespace App\Exports;

use App\Models\BaseSimov;
use App\Models\GestaoImoveisCaixa\DistratoRelacaoDespesas;
use App\Models\GestaoImoveisCaixa\DistratoDemanda;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PlanilhaDespesasDistratoDle implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    protected $idDistrato;
    
    public function __construct($idDistrato)
    {
        $this->idDistrato = $idDistrato; 
    }
    
    public function query()
    {
        // dd(DistratoDemanda::query()->where('idDistrato', $this->idDistrato));
        return DistratoDemanda::query()->where('idDistrato', $this->idDistrato);
    }

    public function map($relacaoDespesasDistrato): array
    {        
        $dadosDemandaDistrato = DistratoDemanda::where('idDistrato', $this->idDistrato)->first();
        $dadosSimov = BaseSimov::where('BEM_FORMATADO', $dadosDemandaDistrato->contratoFormatado)->first();
        $relacaoDespesas = DistratoRelacaoDespesas::where('idDistrato',  $this->idDistrato)->where('devolucaoPertinente', 'SIM')->get();
        $arrayDleDemanda = [];
        
        $arrayDleDemanda = self::montaDleLevantamentoRecursos($arrayDleDemanda, $dadosDemandaDistrato, $dadosSimov, $relacaoDespesas);
        $arrayDleDemanda = self::montaDleAlocacaoRecursos($arrayDleDemanda, $dadosDemandaDistrato, $dadosSimov, $relacaoDespesas);
        // dd($arrayDleDemanda);
        return $arrayDleDemanda;
    }

    public function headings(): array
    {
        return [
            ['CAIXA'], 
            ["FINALIDADE", "ENTIDADE", "UNIDADE MOVIMENTO", "TIPO DE MOVIMENTO", "DATA DE MOVIMENTO", "HISTÓRICO", "EVENTO", "PRODUTO", "UNIDADE DESTINO", "SITUAÇÃO LANCAMENTO", "DATA EFETIVA", "NÚMERO DE AVISO", "CENTRO DE CUSTO", "VALOR", "QUANTIDADE", "TIPO ANALÍTICO", "ANALÍTICO", "PROJETO", "EMPENHO", "SEGMENTO/CARTEIRA", "NÚMERO DE CONCILIAÇÃO", "OBJETO CUSTEIO"],
        ];
    }

    public static function montaDleLevantamentoRecursos($arrayDleDemanda, $dadosDemandaDistrato, $dadosSimov, $relacaoDespesas)
    {
        $valorTotalLevantamento = 0;
        
        // REALIZAR O LEVANTAMENTO DAS DESPESAS RELACIONADA AOS RECURSOS PROPRIOS, FGTS, FINANCIAMENTO, MULTA E PARCELAMENTO
        foreach ($relacaoDespesas as $despesa) {
            switch ($despesa->tipoDespesa) {
                case 'RECURSOS PROPRIOS':
                    $dataEfetivaLevantamento = Carbon::parse($despesa->dataEfetivaDaDespesa)->format('d/m/Y');
                    $valorTotalLevantamento += $despesa->valorDespesa;
                    break;
                // case 'FGTS':
                case 'MULTA':
                case 'FINANCIAMENTO E FGTS':
                case 'PARCELAMENTO E FGTS':
                    $valorTotalLevantamento += $despesa->valorDespesa;
                    break;
                default:
                break;
            }
        }

        // DEFINE O EVENTO DA DLE DE LEVANTAMENTO DE RECURSOS
        switch ($dadosSimov->CLASSIFICACAO) {
            // PATRIMONIAL
            case 'Patrimonial':
            case 'Patrimonial - Alienação Fiduciária':
            case 'Patrimonial -Realização de Garantia':
                $eventoLevantamento = '28246-4';
                $situacaoLancamentoLevantamento = '1 - Normal';
                break;
            //CAIXA OU EMGEA
            case 'EMGEA':
            case 'EMGEA - Realização de Garantia':
            case 'EMGEA- Alienação Fiduciária':
            case 'PANAMERICANO':
            case 'Oriundo do Crédito Imobiliário':
            case 'Oriundos SFI-Gar. Fiduciária':
            case 'SFI - Gar.Fid.Reg.Créd.Imob':
                $eventoLevantamento = '1295-5';
                $situacaoLancamentoLevantamento = '2 - Estorno';
                break;
        }

        array_push($arrayDleDemanda, [
            // "FINALIDADE"
            'Para Autenticação em CAIXA',
            // "ENTIDADE"
            '',
            // "UNIDADE MOVIMENTO"
            $dadosDemandaDistrato->agenciaContratacaoDistrato,
            // "TIPO DE MOVIMENTO"
            'Normal',
            // "DATA DE MOVIMENTO"
            Carbon::now()->format('d/m/Y'),
            // "HISTÓRICO"
            'Distrato do imóvel CHB ' . $dadosSimov->NU_BEM,
            // "EVENTO"
            $eventoLevantamento,
            // "PRODUTO"
            '',
            // "UNIDADE DESTINO"
            '',
            // "SITUAÇÃO LANCAMENTO"
            $situacaoLancamentoLevantamento,
            // "DATA EFETIVA"
            $dataEfetivaLevantamento,
            // "NÚMERO DE AVISO"
            '',
            // "CENTRO DE CUSTO"
            '',
            // "VALOR"
            $valorTotalLevantamento,
            // "QUANTIDADE"
            '1',
            // "TIPO ANALÍTICO"
            '',
            // "ANALÍTICO"
            '',
            // "PROJETO"
            '',
            // "EMPENHO"
            '',
            // "SEGMENTO/CARTEIRA"
            '',
            // "NÚMERO DE CONCILIAÇÃO"
            '',
            // "OBJETO CUSTEIO"
            '',
        ]);

        return $arrayDleDemanda;
    }

    public static function montaDleAlocacaoRecursos($arrayDleDemanda, $dadosDemandaDistrato, $dadosSimov, $relacaoDespesas)
    {
        $produto = '';
        $centroCusto = '';
        $numeroConciliacao = '';
        $projeto = '';
        foreach ($relacaoDespesas as $despesa) {
            switch ($despesa->tipoDespesa) {
                case 'AUTORIZADAS REEMBOLSO EMGEA':
                    $evento = '02534-8';
                    $numeroConciliacao = $dadosSimov->NU_BEM;
                    $historico = "Reembolso autorizado pela EMGEA do Distrato CHB $dadosSimov->NU_BEM";
                    break;
                case 'BENFEITORIAS':
                case 'COMISSAO DE LEILOEIRO':
                case 'CONDOMINIO':
                case 'CUSTAS CARTORARIAS':
                case 'IPTU':
                case 'ITBI':
                    $evento = '08679-7';
                    $produto = '0427-6';
                    $numeroConciliacao = $dadosSimov->NU_BEM;
                    $historico = "Reembolso de $despesa->tipoDespesa do Distrato CHB $dadosSimov->NU_BEM";
                    $centroCusto = '7257';
                    $projeto = '990630';
                    break;
                case 'FINANCIAMENTO E FGTS':
                    $evento = '0223-2';
                    $historico = "Estorno de financiamento do distrato CHB $dadosSimov->NU_BEM";
                    break;
                case 'MULTA':
                    $evento = '22361-4';
                    $historico = "Reversão em multa do processo de distrato CHB $dadosSimov->NU_BEM";
                    break;
                case 'PARCELAMENTO E FGTS':
                    $evento = '0223-2';
                    $historico = "Estorno de parcelamento do distrato CHB $dadosSimov->NU_BEM";
                    break;
                case 'PARCELAS E TAXAS DE FINANCIAMENTO':
                    $evento = '0203-8';
                    $historico = "Devolução de parcelas de financiamento do distrato CHB $dadosSimov->NU_BEM";
                    break;
            }
            
            if ($despesa->tipoDespesa !== 'RECURSOS PROPRIOS') {
                array_push($arrayDleDemanda, [
                    // "FINALIDADE"
                    'Para Autenticação em CAIXA',
                    // "ENTIDADE"
                    '',
                    // "UNIDADE MOVIMENTO"
                    $dadosDemandaDistrato->agenciaContratacaoDistrato,
                    // "TIPO DE MOVIMENTO"
                    'Normal',
                    // "DATA DE MOVIMENTO"
                    Carbon::now()->format('d/m/Y'),
                    // "HISTÓRICO"
                    $historico,
                    // "EVENTO"
                    $evento,
                    // "PRODUTO"
                    $produto == null ? '' : $produto,
                    // "UNIDADE DESTINO"
                    '',
                    // "SITUAÇÃO LANCAMENTO"
                    '1 - Normal',
                    // "DATA EFETIVA"
                    '',
                    // "NÚMERO DE AVISO"
                    '',
                    // "CENTRO DE CUSTO"
                    $centroCusto == null ? '' : $centroCusto,
                    // "VALOR"
                    $despesa->valorDespesa,
                    // "QUANTIDADE"
                    '1',
                    // "TIPO ANALÍTICO"
                    '',
                    // "ANALÍTICO"
                    '',
                    // "PROJETO"
                    $projeto,
                    // "EMPENHO"
                    '',
                    // "SEGMENTO/CARTEIRA"
                    '',
                    // "NÚMERO DE CONCILIAÇÃO"
                    $numeroConciliacao == null ? '' : $numeroConciliacao,
                    // "OBJETO CUSTEIO"
                    '',
                ]);
            }
        }
        return $arrayDleDemanda;
    }
}
