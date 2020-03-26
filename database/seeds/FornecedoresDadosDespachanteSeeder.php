<?php

use Illuminate\Database\Seeder;

class FornecedoresDadosDespachanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_FORNECEDORES_DADOS_DESPACHANTE')->truncate();

        DB::table('TBL_FORNECEDORES_DADOS_DESPACHANTE')->insert([
            'numeroContrato'                            => '8603/2019',
            'dataVencimentoContrato'                    => '2020-09-01',
            'cnpjDespachante'                           => '24.868.400/0001-81',
            'nomeDespachante'                           => 'DTN IMOBILIARIA E SERVICOS ESPECIALIZADOS EIRELI ME',
            'telefoneDespachante'                       => '(11) 2925-7664',
            'emailDespachante'                          => 'mail.teste@dtn.com.br',
            'nomePrimeiroResponsavelDespachante'        => 'Lucio Rodrigues',
            'telefonePrimeiroResponsavelDespachante'    => '(11) 2925-7665',
            'emailPrimeiroResponsavelDespachante'       => 'luciolauro.rodrigues@gmail.com',
            'nomeSegundoResponsavelDespachante'         => null,
            'telefoneSegundoResponsavelDespachante'     => null,
            'emailSegundoResponsavelDespachante'        => null,
            'nomeTerceiroResponsavelDespachante'        => null,
            'telefoneTerceiroResponsavelDespachante'    => null,
            'emailTerceiroResponsavelDespachante'       => null,
            'unidadeGestora'                            => '7257',
            'despachanteAtivo'                          => true,
            'dataCadastro'                              => '2020-03-25 17:16:00.000',
            'dataAlteracao'                             => '2020-03-25 17:16:00.000',
        ]);
    }
}
