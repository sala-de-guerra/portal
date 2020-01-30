<?php

namespace App\Exports;

use App\Models\GestaoImoveisCaixa\DistratoRelacaoDespesas;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PlanilhaDespesasDistratoDle implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    protected $idDistrato;
    
    public function __construct($idDistrato)
    {
        $this->idDistrato = $idDistrato; 
    }
    
    /**
    */
    public function query()
    {
        return DistratoRelacaoDespesas::where('idDistrato', $this->idDistrato)->where('devolucaoPertinente', 'SIM')->get();
    }

    /**
    * @var PlanilhaDespesasDistratoDle $relacaoDespesasDistrato
    */
    public function map($relacaoDespesasDistrato): array
    {        
        return [
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
            $relacaoDespesasDistrato->tipoDespesa,
        ];
    }

    public function headings(): array
    {
        return ["FINALIDADE", "ENTIDADE", "UNIDADE MOVIMENTO", "TIPO DE MOVIMENTO", "DATA DE MOVIMENTO", "HISTÓRICO", "EVENTO", "PRODUTO", "UNIDADE DESTINO", "SITUAÇÃO LANCAMENTO", "DATA EFETIVA", "NÚMERO DE AVISO", "CENTRO DE CUSTO", "VALOR", "QUANTIDADE", "TIPO ANALÍTICO", "ANALÍTICO", "PROJETO", "EMPENHO", "SEGMENTO/CARTEIRA", "NÚMERO DE CONCILIAÇÃO", "OBJETO CUSTEIO"];
    }
}
