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
            'statusAnalise' => 'INICIAR ANÁLISE',
            'motivoDistrato' => 'AÇÃO JUDICIAL',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '01.4444.0441059-9',
            'nomeProponente' => 'AURORA BOREAL DESAPARECIDA DE MOURÃO',
            'statusAnalise' => 'AGUARDA DOC CLIENTE',
            'motivoDistrato' => 'IMPOSSIBIL. DE REGISTRO AQUISIÇÃO',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '01.4444.0326764-4',
            'nomeProponente' => 'ROSAMARIA DE OLARIA GIANDULA',
            'statusAnalise' => 'COMANDOS NO CIWEB',
            'motivoDistrato' => 'DESISTÊNCIA',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '00.0000.1000833-9',
            'nomeProponente' => 'THIELES BABOSA PÃO',
            'statusAnalise' => 'ENCAMINHADO AGÊNCIA',
            'motivoDistrato' => 'AÇÃO JUDICIAL',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '01.4444.0386904-0',
            'nomeProponente' => 'EDWARD SMITH',
            'statusAnalise' => 'CONCLUÍDO',
            'motivoDistrato' => 'LEILÕES NEGATIVOS',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '01.5555.1397093-7',
            'nomeProponente' => 'MIQUELANGELO PEROBA SILVEIRA',
            'statusAnalise' => 'AVERBAÇÃO DISTRATO',
            'motivoDistrato' => 'ERRO FORMAL DE EDITAL',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '08.5555.2525120-3',
            'nomeProponente' => 'PANELA RIBEIRINHA DA REPRESA',
            'statusAnalise' => 'COMANDOS NO CIWEB',
            'motivoDistrato' => 'CRÉDITO NÃO APROVADO',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '08.5555.0984374-6',
            'nomeProponente' => 'MULTIPLICA SENHOR PARTICIPAÇÕES LIMITADAS',
            'statusAnalise' => 'ENCAMINHADO AGÊNCIA',
            'motivoDistrato' => 'EX-MUTUÁRIO EXERCEU DIREITO DE PREFERÊNCIA',
        ]);

        DB::table('TBL_DISTRATOS_DEMANDAS')->insert([
            'contratoFormatado' => '01.4444.0584783-4',
            'nomeProponente' => 'ANDORE MONTEVAI NARDONI',
            'statusAnalise' => 'CONCLUÍDO',
            'motivoDistrato' => 'DISTRATO CANCELADO',
        ]);
    }
}
