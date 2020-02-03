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
        $situacaoLancamento = '1 - Normal';
        
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
                case 'FINANCIAMENTO E FGTS':
                case 'PARCELAMENTO E FGTS':
                    $valorTotalLevantamento += $despesa->valorDespesa;
                    break;
                default:
                break;

            }
        }

        // DEFINE O EVENTO DA DLE DE LEVANTAMENTO DE RECURSOS
        switch ($objBaseSimov->CLASSIFICACAO) {
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

        switch ($despesa->tipoDespesa) {
            case 'AUTORIZADAS REEMBOLSO EMGEA':
                $evento = '02534-8';
                $numeroConciliacao = $dadosSimov->NU_BEM;
                break;
            // case 'FGTS':
            case 'BENFEITORIAS':
                $evento = '08679-7';
                $produto = '0427-6';
                $numeroConciliacao = $dadosSimov->NU_BEM;
                break;
            case 'COMISSAO DE LEILOEIRO':
                $evento = '08679-7';
                $produto = '0427-6';
                $numeroConciliacao = $dadosSimov->NU_BEM;
                break;
            case 'CONDOMINIO':
                $evento = '08679-7';
                $produto = '0427-6';
                $numeroConciliacao = $dadosSimov->NU_BEM;
                break;
            case 'CUSTAS CARTORARIAS':
                $evento = '08679-7';
                $produto = '0427-6';
                $numeroConciliacao = $dadosSimov->NU_BEM;
                break;
            case 'FINANCIAMENTO E FGTS':
                $evento = '0223-2';
                break;
            case 'IPTU':
                $evento = '08679-7';
                $produto = '0427-6';
                $numeroConciliacao = $dadosSimov->NU_BEM;
                break;
            case 'ITBI':
                $evento = '08679-7';
                $produto = '0427-6';
                $numeroConciliacao = $dadosSimov->NU_BEM;
                break;
            case 'MULTA':
                $evento = '22361-4';
                break;
            case 'PARCELAMENTO E FGTS':
                $evento = '0223-2';
                break;
            case 'PARCELAS E TAXAS DE FINANCIAMENTO':
                $evento = '0203-8';
                break;
            case 'RECURSOS PROPRIOS':
                $evento = $eventoLevantamento;
                $situacaoLancamento = $situacaoLancamentoLevantamento;
                break;
        }
        
        return [
            // "FINALIDADE"
            'Para Autenticação em CAIXA',
            // "ENTIDADE"
            '',
            // "UNIDADE MOVIMENTO"
            $dadosDemandaDistrato->agenciaContratacaoDistrato,
            // "TIPO DE MOVIMENTO"
            'Normal',
            // "DATA DE MOVIMENTO"
            '',
            // "HISTÓRICO"
            '',
            // "EVENTO"
            $evento,
            // "PRODUTO"
            $produto,
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
            $numeroConciliacao,
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
