<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;


class criaExcelVilopUnidade implements FromCollection, WithHeadings, ShouldAutoSize


{
    protected $unidade;

    function __construct($unidade) {
        $this->unidade = $unidade;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
      
    //     $criaPlanilha = DB::table('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS')
    //     ->leftjoin('TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS', DB::raw('CONVERT(VARCHAR, TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.IdMacro)'), '=', DB::raw('CONVERT(VARCHAR, TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.IdMacroProcesso)'))
    //     ->select(DB::raw("
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.[CGC_UNIDADE],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.[NOME_UNIDADE],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.[NOME_MACROATIVIDADE],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[NOME_MICROATIVIDADE],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[MENSURAVEL],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[VOLUME_TOTAL_DEMANDA],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[VOLUME_TOTAL_TRATADA],
    //     CONVERT(varchar(25), TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[PERIODO_TRATADO_DE], 103) as periodoDE,
    //     CONVERT(varchar(25), TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[PERIODO_TRATADO_ATE], 103) as periodoATE,
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[MEDIA_DIA],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS .[TEMPO_EM_MINUTOS],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[NIVEL_COMPLEXIDADE],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[NIVEL_AUTOMACAO],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[GRAU_CRITICIDADE],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[GRAU_PADRONIZACAO],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[GRAU_AUTONOMIA],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[SISTEMA_ORIGEM_INFORMACAO],
    //     TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.[QTDE_PESSOAS_ALOCADAS]

    //   "))
    //     ->where('TBL_PRODUTIVIDADE_VILOP_TBL_MICROPROCESSOS.EXCLUIDO_USUARIO', 'N')
    //     ->where('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.EXCLUIDO_USUARIO', 'N')
    //     ->where('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.CGC_UNIDADE', $this->unidade)
    //     ->orderBy('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.CGC_UNIDADE', 'asc')
    //     ->orderBy('TBL_PRODUTIVIDADE_VILOP_TBL_MACROPROCESSOS.IdMacro', 'asc')
    //     ->get();

    //     return $criaPlanilha;
        
    // }

    public function collection()
    {
      
        $criaPlanilha = DB::table('produtividade.TB_RELACAO_CGC_MACRO_MICRO')
        ->join('produtividade.TB_MACROPROCESSOS', DB::raw('CONVERT(VARCHAR, produtividade.TB_MACROPROCESSOS.ID_MACRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MACRO)'))
        ->leftjoin('produtividade.TB_MICROPROCESSO', DB::raw('CONVERT(VARCHAR, produtividade.TB_MICROPROCESSO.ID_MICRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_MICRO)'))
        ->join('produtividade.TB_CARGA_MENSAL', DB::raw('CONVERT(VARCHAR, produtividade.TB_CARGA_MENSAL.ID_AG_MACRO_MICRO)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_RELACAO_CGC_MACRO_MICRO.ID_AG_MACRO_MICRO)'))
        ->join('produtividade.TB_CONTROLE_PROCESSO', DB::raw('CONVERT(VARCHAR, produtividade.TB_CONTROLE_PROCESSO.ID_CARGA)'), '=', DB::raw('CONVERT(VARCHAR, produtividade.TB_CARGA_MENSAL.ID_CARGA)'))
        ->select(DB::raw("
        TB_RELACAO_CGC_MACRO_MICRO.[NU_CGC],
        TB_MACROPROCESSOS.[DE_MACRO],
        TB_MICROPROCESSO.[DE_MICRO],
        CASE WHEN TB_MICROPROCESSO.IC_MENSURAVEL = 'S' THEN 'SIM' ELSE 'NÃO' END AS MENSURAVEL,
        TB_CARGA_MENSAL.[VOLUME_TOTAL_DEMANDA],
        TB_CARGA_MENSAL.[VOLUME_TOTAL_TRATADA],
        TB_CONTROLE_PROCESSO.[MM_REFERENCIA],
        TB_CONTROLE_PROCESSO.[AA_REFERENCIA],
        TB_CARGA_MENSAL.[MEDIA_DIA],
        TB_CARGA_MENSAL.[TEMPO_EM_MINUTOS],
        TB_CARGA_MENSAL.[NIVEL_COMPLEXIDADE],
        TB_CARGA_MENSAL.[NIVEL_AUTOMACAO],
        TB_CARGA_MENSAL.[GRAU_CRITICIDADE],
        TB_CARGA_MENSAL.[GRAU_PADRONIZACAO],
        TB_CARGA_MENSAL.[GRAU_AUTONOMIA],
        TB_CARGA_MENSAL.[SISTEMA_ORIGEM_INFORMACAO],
        TB_CARGA_MENSAL.[QTDE_PESSOAS_ALOCADAS]

      "))
        ->distinct('TB_MACROPROCESSOS.ID_MACRO')
        ->where('TB_RELACAO_CGC_MACRO_MICRO.NU_CGC', $this->unidade)
        ->where('TB_MACROPROCESSOS.IC_ATIVO', 1)
        ->where('TB_RELACAO_CGC_MACRO_MICRO.IC_ATIVO', 1)
        ->get();

        return $criaPlanilha;
        
    }

    public function headings(): array
    {
        return [
            [
            'CGC_UNIDADE',
            'NOME_MACROATIVIDADE',
            'NOME_MICROATIVIDADE',
            'MENSURAVEL',
            'VOLUME_TOTAL_DEMANDA',
            'VOLUME_TOTAL_TRATADA',
            'MES_REFERENCIA',
            'ANO_REFERENCIA',
            'MEDIA_DIA',
            'TEMPO_EM_MINUTOS',
            'NIVEL_COMPLEXIDADE',
            'NIVEL_AUTOMACAO',
            'GRAU_CRITICIDADE',
            'GRAU_PADRONIZACAO',
            'GRAU_AUTONOMIA',
            'SISTEMA_ORIGEM_INFORMACAO',
            'QTDE_PESSOAS_ALOCADAS'
            ],
        ];
    }
}