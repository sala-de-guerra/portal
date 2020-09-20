<?php

namespace App\Exports;
use App\Models\Laudo\Laudo;
use App\Models\BaseSimov;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Classes\Ldap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;



class CriaExcelLaudo implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $codigoUnidadeUsuarioSessao = Ldap::defineUnidadeUsuarioSessao();
        $siglaGilie = Ldap::defineSiglaUnidadeUsuarioSessao($codigoUnidadeUsuarioSessao);
        $criaPlanilha = DB::table('ALITB001_Imovel_Completo')
            ->leftjoin('TBL_CONTROLE_LAUDO', DB::raw('CONVERT(VARCHAR, ALITB001_Imovel_Completo.BEM_FORMATADO)'), '=', DB::raw('CONVERT(VARCHAR, TBL_CONTROLE_LAUDO.BEM_FORMATADO)'))
            ->select(DB::raw('
                    ALITB001_Imovel_Completo.[BEM_FORMATADO] as BEM_FORMATADO,
                    ALITB001_Imovel_Completo.[NU_BEM] as NU_BEM,
                    ALITB001_Imovel_Completo.[STATUS_IMOVEL] as STATUS_IMOVEL,
                    CONVERT(VARCHAR, ALITB001_Imovel_Completo.[DATA_LAUDO], 103) as DATA_LAUDO,
                    CONVERT(VARCHAR, ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO], 103) as DATA_VENCIMENTO_LAUDO,
                    datediff(day,getdate(), ALITB001_Imovel_Completo.[DATA_VENCIMENTO_LAUDO]) as quanto_falta,
                    ALITB001_Imovel_Completo.[CLASSIFICACAO] as CLASSIFICACAO,
                    TBL_CONTROLE_LAUDO.[observacao] as observacao,
                    TBL_CONTROLE_LAUDO.[numeroOS] as numeroOS,
                    TBL_CONTROLE_LAUDO.[statusSiopi] as statusSiopi,
                    TBL_CONTROLE_LAUDO.[nomeEngenharia] as nomeEngenharia,
                    TBL_CONTROLE_LAUDO.[emailEngenharia] as emailEngenharia,
                    TBL_CONTROLE_LAUDO.[cnpjEngenharia] as cnpjEngenharia
                  
            '))
             ->where('ALITB001_Imovel_Completo.UNA', '=', $siglaGilie)
             ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'Vendido')
             ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'devolvido')
             ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'excluído')
             ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'arrendado')
             ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'em cadastramento')
             ->where('ALITB001_Imovel_Completo.STATUS_IMOVEL', '<>', 'Indício de Fraude')
             ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA- Alienação Fiduciária')
             ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA - Realização de Garantia')
             ->where('ALITB001_Imovel_Completo.CLASSIFICACAO', '<>', 'EMGEA')
             ->orderBy('quanto_falta', 'asc')
             ->get();

        return $criaPlanilha;
     }


    public function headings(): array
    {

        return [
            ['Bem Formatado',
            'Bem',
            'Status Imovel',
            'Data Laudo',
            'Vencimento Laudo',
            'Vencimento (dias)',
            'Classificação',
            'Observação',
            'O.S', 
            'Status Siopi',
            'Engenharia',
            'Email Engenharia',
            'CNPJ Engenharia'
            ],
        ];
    }
}