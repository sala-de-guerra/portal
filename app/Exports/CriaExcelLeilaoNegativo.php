<?php

namespace App\Exports;
use App\Models\LeilaoNegativo\LeilaoNegativoExcel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Classes\Ldap;
use Illuminate\Support\Carbon;




class CriaExcelLeilaoNegativo implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $unidade = Ldap::defineUnidadeUsuarioSessao();
        $criaPlanilha = LeilaoNegativoExcel::where('unidadeResponsavel', $unidade)
        ->select('contratoFormatado', 
        'dataSegundoLeilao',
        'numeroLeilao', 
        'statusAverbacao', 
        'idLeiloeiro', 
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
            'Data Segundo Leilao',
            'Numero Leilao', 
            'Status Averbacao', 
            'Nº id Leiloeiro', 
            'Entrega Documentos Leiloeiro', 
            'Retirada Documentos Despachante', 
            'Número Oficio Unidade', 
            'Previsao Entrega Doc Cartorio', 
            'Número Protocolo Cartorio', 
            'Código Acesso Protocolo', 
            'Previsão Analise Cartório', 
            'Retirada Documento Cartório',
            'existeExigencia', 
            'Entrega Averbacao Exigencia Unidade'
            ],
        ];
    }

    // public function columnFormats(): array
    // {
    //     $criaPlanilha = $this->collection();
  
    //     return [
    //         'B' => Date::stringToExcel($criaPlanilha[1])
    //     ];
    // }

}
