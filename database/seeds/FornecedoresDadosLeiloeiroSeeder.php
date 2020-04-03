<?php

use Illuminate\Database\Seeder;

class FornecedoresDadosLeiloeiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_FORNECEDORES_DADOS_LEILOEIRO')->truncate();

        DB::table('TBL_FORNECEDORES_DADOS_LEILOEIRO')->insert([
            'numeroContrato'                    => '1234/2020',
            'classificacaoImoveisLeilao'        => 'EMGEA',
            'dataVencimentoContrato'            => '2020-12-31',
            'nomeLeiloeiro'                     => 'HUGO LEONARDO ALVARENGA CUNHA',
            'telefoneLeiloeiro'                 => '(11) 3053-0001',
            'emailLeiloeiro'                    => 'hugo_leiloeiro@nossoleilao.com.br',
            'enderecoLeiloeiro'                 => 'Av. Indianópolis, 2818 - Planalto Paulista - São Paulo / SP',
            'nomeEmpresaAssessoraLeiloeiro'     => 'NOSSO LEILÃO',
            'telefoneEmpresaAssessoraLeiloeiro' => '5586-3000',
            'emailEmpresaAssessoraLeiloeiro'    => 'contato@nossoleilao.com.br',
            'siteEmpresaAssessoraLeiloeiro'     => 'http://www.nossoleilao.com.br',
            'enderecoEmpresaAssessoraLeiloeiro' => 'Av. Indianópolis, 2818 - Planalto Paulista - São Paulo / SP',
            'enderecoRealizacaoLeilao'          => 'Rua Professor Zeferino Vaz, 247 - Vila Arapuá - São Paulo / SP',
            'unidadeGestora'                    => '7257',
            'dataCadastro'                      => '2020-04-02 13:30:00',
            'dataAlteracao'                     => '2020-04-02 13:30:00',
        ]);
        DB::table('TBL_FORNECEDORES_DADOS_LEILOEIRO')->insert([
            'numeroContrato'                    => '5678/2020',
            'classificacaoImoveisLeilao'        => 'CAIXA',
            'dataVencimentoContrato'            => '2021-12-31',
            'nomeLeiloeiro'                     => 'WASHINGTON LUIZ PEREIRA VIZEU',
            'telefoneLeiloeiro'                 => '(11) 99755-8776',
            'emailLeiloeiro'                    => 'washington@vizeuonline.com.br',
            'enderecoLeiloeiro'                 => 'Av. Indianópolis, 2895 - Planalto Paulista - São Paulo / SP',
            'nomeEmpresaAssessoraLeiloeiro'     => 'VIZEU LEILOEIRO OFICIAL',
            'telefoneEmpresaAssessoraLeiloeiro' => '(11) 5071-8555',
            'emailEmpresaAssessoraLeiloeiro'    => 'faleconosco@vizeuonline.com.br',
            'siteEmpresaAssessoraLeiloeiro'     => 'http://www.nossoleilao.com.br',
            'enderecoEmpresaAssessoraLeiloeiro' => 'Av. Nosa. Sra. dos Navegantes, 1900 - Jd. Eldorado',
            'enderecoRealizacaoLeilao'          => 'Av. Nosa. Sra. dos Navegantes, 1900 - Jd. Eldorado',
            'unidadeGestora'                    => '7257',
            'dataCadastro'                      => '2020-04-02 13:30:00',
            'dataAlteracao'                     => '2020-04-02 13:30:00',
        ]);
    }
}
