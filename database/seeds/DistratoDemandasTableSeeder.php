<?php

use Illuminate\Database\Seeder;

class DistratoDemandasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '00.0000.1000411-2',
            'nomeProponente' => 'DOUGLAS DOUGRAS DA SILVA',
            'statusAnaliseDistrato' => 'INICIAR ANALISE',
            'motivoDistrato' => 'ACAO JUDICIAL',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '01.4444.0441059-9',
            'nomeProponente' => 'AURORA BOREAL DESAPARECIDA DE MOURAO',
            'statusAnaliseDistrato' => 'AGUARDA DOC CLIENTE',
            'motivoDistrato' => 'IMPOSSIBIL. DE REGISTRO AQUISICAO',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '01.4444.0326764-4',
            'nomeProponente' => 'ROSAMARIA DE OLARIA GIANDULA',
            'statusAnaliseDistrato' => 'COMANDOS NO CIWEB',
            'motivoDistrato' => 'DESISTENCIA',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '00.0000.1000833-9',
            'nomeProponente' => 'THIELES BABOSA PÃO',
            'statusAnaliseDistrato' => 'ENCAMINHADO AGENCIA',
            'motivoDistrato' => 'ACAO JUDICIAL',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '01.4444.0386904-0',
            'nomeProponente' => 'EDWARD SMITH',
            'statusAnaliseDistrato' => 'CONCLUIDO',
            'motivoDistrato' => 'LEILOES NEGATIVOS',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '01.5555.1397093-7',
            'nomeProponente' => 'MIQUELANGELO PEROBA SILVEIRA',
            'statusAnaliseDistrato' => 'AVERBACAO DISTRATO',
            'motivoDistrato' => 'ERRO FORMAL DE EDITAL',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '08.5555.2525120-3',
            'nomeProponente' => 'PANELA RIBEIRINHA DA REPRESA',
            'statusAnaliseDistrato' => 'COMANDOS NO CIWEB',
            'motivoDistrato' => 'CREDITO NAO APROVADO',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '08.5555.0984374-6',
            'nomeProponente' => 'MULTIPLICA SENHOR PARTICIPAÇÕES LIMITADAS',
            'statusAnaliseDistrato' => 'ENCAMINHADO AGENCIA',
            'motivoDistrato' => 'EX-MUTUARIO EXERCEU DIREITO DE PREFERENCIA',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '01.4444.0584783-4',
            'nomeProponente' => 'ANDORE MONTEVAI NARDONI',
            'statusAnaliseDistrato' => 'CONCLUIDO',
            'motivoDistrato' => 'DISTRATO CANCELADO',
        ]);
    }
}
