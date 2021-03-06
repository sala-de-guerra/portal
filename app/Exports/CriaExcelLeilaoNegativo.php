<?php

namespace App\Exports;
use App\Models\LeilaoNegativo\LeilaoNegativoExcel;
use App\Models\BaseSimov;
use App\Models\Fornecedores\Leiloeiro;
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


class CriaExcelLeilaoNegativo implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $unidade = Ldap::defineUnidadeUsuarioSessao();
        $criaPlanilha = LeilaoNegativoExcel::where('unidadeResponsavel', $unidade)
        ->join('ALITB001_Imovel_Completo', 'ALITB001_Imovel_Completo.BEM_FORMATADO',  "=", 'TBL_LEILOES_NEGATIVOS_CONTRATOS.contratoFormatado')
        ->leftjoin('TBL_FORNECEDORES_DADOS_LEILOEIRO', 'TBL_FORNECEDORES_DADOS_LEILOEIRO.idLeiloeiro',  "=", 'TBL_LEILOES_NEGATIVOS_CONTRATOS.idLeiloeiro')
        ->leftjoin('TBL_HISTORICO_PORTAL_GILIE', 'TBL_HISTORICO_PORTAL_GILIE.numeroContrato',  "=", 'TBL_LEILOES_NEGATIVOS_CONTRATOS.contratoFormatado')
        ->select('contratoFormatado',
        'ALITB001_Imovel_Completo.MATRICULA',
        'ALITB001_Imovel_Completo.OFICIO',
        'ALITB001_Imovel_Completo.CIDADE',
        'ALITB001_Imovel_Completo.STATUS_IMOVEL',
        'ALITB001_Imovel_Completo.CLASSIFICACAO',
        'dataSegundoLeilao',
        'numeroLeilao', 
        'statusAverbacao', 
        'TBL_FORNECEDORES_DADOS_LEILOEIRO.nomeLeiloeiro', 
        'dataEntregaDocumentosLeiloeiro', 
        'dataRetiradaDocumentosDespachante', 
        'numeroOficioUnidade', 
        'previsaoEntregaDocumentosCartorio', 
        'numeroProtocoloCartorio', 
        'codigoAcessoProtocoloCartorio', 
        'dataPrevistaAnaliseCartorio', 
        'dataRetiradaDocumentoCartorio', 
        'existeExigencia',
        'TBL_HISTORICO_PORTAL_GILIE.observacao',
        'dataEntregaAverbacaoExigenciaUnidade')
        ->orderBy('dataSegundoLeilao', 'desc')
        ->orderBy('TBL_HISTORICO_PORTAL_GILIE.created_at', 'desc')
        ->get();
        $unique = $criaPlanilha->unique('contratoFormatado');
        $unique->values()->all();
        
        return $unique;
     }

    public function headings(): array
    {

        return [
            ['Contrato',
            'Matricula',
            'Oficio',
            'Cidade',
            'Status Imóvel',
            'Classificação',
            'Data Segundo Leilao',
            'Numero Leilao', 
            'Status Averbacao',
            'Leiloeiro', 
            'Entrega Documentos Leiloeiro', 
            'Retirada Documentos Despachante', 
            'Número Oficio Unidade', 
            'Previsao Entrega Doc Cartorio', 
            'Número Protocolo Cartorio', 
            'Código Acesso Protocolo', 
            'Previsão Analise Cartório', 
            'Retirada Documento Cartório',
            'Existe Exigencia',
            'histórico',
            'Entrega Averbacao Exigencia Unidade'
            ],
        ];
    }
}