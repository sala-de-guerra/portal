<?php

namespace App\Exports;

use App\Models\GestaoImoveisCaixa\DistratoRelacaoDespesas;
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
        $finalidade = [
            'Para Finalização no SINAF', 'Para Autenticação em CAIXA'
        ];
        $tipoMovimento = [
            'Normal', 'Prévia Normal', 'Movimento Futuro'
        ];
        $situacaoLancamento = [
            '1 - Normal', '2 - Estorno'
        ];
        $tipoAnalitico = [
            'Sequêncial', 'Pessoa Física', 'Pessoa Jurídica', 'Depósito Judicial'
        ];
        
        return [
            // "FINALIDADE"
            $relacaoDespesasDistrato->tipoDespesa == 'BENFEITORIAS' ? 'Para Finalização no SINAF' : 'Para Autenticação em CAIXA',
            // "ENTIDADE"
            $relacaoDespesasDistrato->tipoDespesa,
            // "UNIDADE MOVIMENTO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "TIPO DE MOVIMENTO"
            $relacaoDespesasDistrato->tipoDespesa == 'BENFEITORIAS' ? 'Normal' : 'Movimento Futuro',
            // "DATA DE MOVIMENTO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "HISTÓRICO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "EVENTO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "PRODUTO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "UNIDADE DESTINO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "SITUAÇÃO LANCAMENTO"
            $relacaoDespesasDistrato->tipoDespesa == 'BENFEITORIAS' ? '1 - Normal' : '2 - Estorno',
            // "DATA EFETIVA"
            Carbon::parse($relacaoDespesasDistrato->dataEfetivaDaDespesa)->format('d/m/Y'),
            // "NÚMERO DE AVISO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "CENTRO DE CUSTO"
            $relacaoDespesasDistrato->tipoDespesa == 'BENFEITORIAS' ? '7257' : '3191',
            // "VALOR"
            // number_format($relacaoDespesasDistrato->valorDespesa, 2, ',', '.'),
            $relacaoDespesasDistrato->valorDespesa,
            // "QUANTIDADE"
            $relacaoDespesasDistrato->tipoDespesa,
            // "TIPO ANALÍTICO"
            $relacaoDespesasDistrato->tipoDespesa == 'BENFEITORIAS' ? 'Pessoa Física' : 'Sequêncial',
            // "ANALÍTICO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "PROJETO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "EMPENHO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "SEGMENTO/CARTEIRA"
            $relacaoDespesasDistrato->tipoDespesa,
            // "NÚMERO DE CONCILIAÇÃO"
            $relacaoDespesasDistrato->tipoDespesa,
            // "OBJETO CUSTEIO"
            $relacaoDespesasDistrato->tipoDespesa,
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
