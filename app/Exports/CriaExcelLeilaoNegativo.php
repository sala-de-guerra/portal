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
        ->select('contratoFormatado',
        'ALITB001_Imovel_Completo.MATRICULA',
        'ALITB001_Imovel_Completo.OFICIO',
        'ALITB001_Imovel_Completo.CIDADE',  
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
        'dataEntregaAverbacaoExigenciaUnidade')
        ->orderBy('dataSegundoLeilao', 'desc')
        ->get();

        return $criaPlanilha;
     }

    public function headings(): array
    {

        return [
            ['Contrato', 
            'Matricula',
            'Oficio',
            'Cidade',
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
            'Entrega Averbacao Exigencia Unidade'
            ],
        ];
    }

}