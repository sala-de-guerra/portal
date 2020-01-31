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
        return DistratoRelacaoDespesas::query()->where('idDistrato', $this->idDistrato);
    }

    public function map($relacaoDespesasDistrato): array
    {        
        $dadosDemandaDistrato = DistratoDemanda::where('idDistrato', $this->idDistrato)->first();
        $dadosSimov = BaseSimov::where('BEM_FORMATADO', $dadosDemandaDistrato->contratoFormatado)->first();
        $relacaoDespesas = DistratoRelacaoDespesas::where('idDistrato',  $this->idDistrato)->where('devolucaoPertinente', 'SIM')->get();
        dd(['dadosSimov' => $dadosSimov, 'dadosDemandaDistrato' => $dadosDemandaDistrato]);
        // REALIZAR O LEVANTAMENTO DAS DESPESAS RELACIONADA AOS RECURSOS PROPRIOS, FGTS, FINANCIAMENTO, MULTA E PARCELAMENTO
        foreach ($relacaoDespesas as $despesa) {
            switch ($despesa->tipoDespesa) {
                case 'RECURSOS PROPRIOS':
                    $dataEfetivaLevantamento = Carbon::parse($despesa->dataEfetivaDaDespesa)->format('d/m/Y');
                    $valorTotalLevantamento += $despesa->valorDespesa;
                    break;
                // case 'FGTS':
                case 'MULTA':
                case 'FINANCIAMENTO':
                case 'PARCELAMENTO':
                    $valorTotalLevantamento += $despesa->valorDespesa;
                    break;
                default:
                break;

            }
        }

        switch ($despesa->tipoDespesa) {
            case 'AUTORIZADAS REEMBOLSO EMGEA':
                $evento = '';
                break;
            // case 'FGTS':
            case 'BENFEITORIAS':
                $evento = '';
                break;
            case 'COMISSAO DE LEILOEIRO':
                $evento = '0223-2';
                break;
            case 'CONDOMINIO':
                $evento = '';
                break;
            case 'CUSTAS CARTORARIAS':
                $evento = '';
                break;
            case 'FGTS':
                $evento = '';
                break;
            case 'FINANCIAMENTO':
                $evento = '';
                break;
            case 'IPTU':
                $evento = '';
                break;
            case 'ITBI':
                $evento = '';
                break;
            case 'MULTA':
                $evento = '';
                break;
            case 'PARCELAMENTO':
                $evento = '';
                break;
            case 'PARCELAS E TAXAS DE FINANCIAMENTO':
                $evento = '';
                break;
            case 'RECURSOS PROPRIOS':
                $evento = '';
                break;
        }
        
        return [
            // "FINALIDADE"
            'Para Autenticação em CAIXA',
            // "ENTIDADE"
            '',
            // "UNIDADE MOVIMENTO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "TIPO DE MOVIMENTO"
            'Normal',
            // "DATA DE MOVIMENTO"
            '',
            // "HISTÓRICO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "EVENTO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "PRODUTO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "UNIDADE DESTINO"
            '',
            // "SITUAÇÃO LANCAMENTO"
            $relacaoDespesasDistrato->tipoDespesa == 'BENFEITORIAS' ? '1 - Normal' : '2 - Estorno',
            // "DATA EFETIVA"
            $dataEfetivaLevantamento == null ? '' : Carbon::parse($dataEfetivaLevantamento)->format('d/m/Y'),
            // "NÚMERO DE AVISO"
            '',
            // "CENTRO DE CUSTO"
            $relacaoDespesasDistrato->tipoDespesa == 'BENFEITORIAS' ? '7257' : '3191',
            // "VALOR"
            // number_format($relacaoDespesasDistrato->valorDespesa, 2, ',', '.'),
            $relacaoDespesasDistrato->valorDespesa,
            // "QUANTIDADE"
            $relacaoDespesasDistrato->tipoDespesa,
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
            $relacaoDespesasDistrato->tipoDespesa,
            // "OBJETO CUSTEIO"
            '',
        ];
    }

    public function headings(): array
    {
        return [
            ['CAIXA'], 
            ["FINALIDADE", "ENTIDADE", "UNIDADE MOVIMENTO", "TIPO DE MOVIMENTO", "DATA DE MOVIMENTO", "HISTÓRICO", "EVENTO", "PRODUTO", "UNIDADE DESTINO", "SITUAÇÃO LANCAMENTO", "DATA EFETIVA", "NÚMERO DE AVISO", "CENTRO DE CUSTO", "VALOR", "QUANTIDADE", "TIPO ANALÍTICO", "ANALÍTICO", "PROJETO", "EMPENHO", "SEGMENTO/CARTEIRA", "NÚMERO DE CONCILIAÇÃO", "OBJETO CUSTEIO"],
        ];
    }
}
