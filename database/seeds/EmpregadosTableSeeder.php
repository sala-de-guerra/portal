<?php

use Illuminate\Database\Seeder;

class EmpregadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_EMPREGADOS')->truncate();

        DB::table('TBL_EMPREGADOS')->insert(['matricula' => 'c111710','nomeCompleto' => 'EDUARDO CHIAKI CHUMAN','primeiroNome' => 'EDUARDO','dataNascimento' => '31484','codigoFuncao' => '2057','nomeFuncao' => 'ASSISTENTE PLENO','codigoLotacaoAdministrativa' => '7257','nomeLotacaoAdministrativa' => 'GI ALIENAR BENS MOVEIS IMOV SAO PAULO,SP','codigoLotacaoFisica' => 'NULL','nomeLotacaoFisica' => 'NULL','created_at' => '2019-03-18 20:57:11.240','updated_at' => '2019-04-16 11:46:02.380',]);
        DB::table('TBL_EMPREGADOS')->insert(['matricula' => 'c079436','nomeCompleto' => 'VLADIMIR PEREIRA DE LEMOS','primeiroNome' => 'VLADIMIR','dataNascimento' => '30416','codigoFuncao' => '2061','nomeFuncao' => 'COORDENADOR FILIAL','codigoLotacaoAdministrativa' => '7257','nomeLotacaoAdministrativa' => 'GI ALIENAR BENS MOVEIS IMOV SAO PAULO,SP','codigoLotacaoFisica' => 'NULL','nomeLotacaoFisica' => 'NULL','created_at' => '2019-03-18 21:38:08.663','updated_at' => '2019-05-21 13:34:57.553',]);
        DB::table('TBL_EMPREGADOS')->insert(['matricula' => 'c126768','nomeCompleto' => 'EDSON BERNARDO DIAS','primeiroNome' => 'EDSON','dataNascimento' => '27498','codigoFuncao' => '2322','nomeFuncao' => 'GER RELACION PJ PUB PRIV','codigoLotacaoAdministrativa' => '928','nomeLotacaoAdministrativa' => 'AG. RIBEIRAO PIRES, SP','codigoLotacaoFisica' => 'NULL','nomeLotacaoFisica' => 'NULL','created_at' => '2019-03-19 20:11:50.493','updated_at' => '2019-03-29 16:28:04.483',]);
        DB::table('TBL_EMPREGADOS')->insert(['matricula' => 'c032579','nomeCompleto' => 'EUCLIDIO FRASSON BRISTOT','primeiroNome' => 'EUCLIDIO','dataNascimento' => '25097','codigoFuncao' => '2321','nomeFuncao' => 'GER RELACION PJ PUB PRIV','codigoLotacaoAdministrativa' => '457','nomeLotacaoAdministrativa' => 'AG. BENTO GONCALVES, RS','codigoLotacaoFisica' => 'NULL','nomeLotacaoFisica' => 'NULL','created_at' => '2019-03-22 19:32:19.813','updated_at' => '2019-03-22 19:32:19.813',]);
        DB::table('TBL_EMPREGADOS')->insert(['matricula' => 'c142765','nomeCompleto' => 'CARLOS ALBERTO DALCIN DAVID','primeiroNome' => 'CARLOS','dataNascimento' => 'NULL','codigoFuncao' => '2056','nomeFuncao' => 'ASSISTENTE JUNIOR','codigoLotacaoAdministrativa' => '7257','nomeLotacaoAdministrativa' => 'GI ALIENAR BENS MOVEIS IMOV SAO PAULO,SP','codigoLotacaoFisica' => 'NULL','nomeLotacaoFisica' => 'NULL','created_at' => '2019-04-16 15:02:04.330','updated_at' => '2019-04-16 15:02:04.330',]);
        DB::table('TBL_EMPREGADOS')->insert(['matricula' => 'c098453','nomeCompleto' => 'RAFAEL PIMENTEL GONCALVES','primeiroNome' => 'RAFAEL','dataNascimento' => '1984-12-09','codigoFuncao' => 'NULL','nomeFuncao' => 'NULL','codigoLotacaoAdministrativa' => '7257','nomeLotacaoAdministrativa' => 'GI ALIENAR BENS MOVEIS IMOV SAO PAULO,SP','codigoLotacaoFisica' => 'NULL','nomeLotacaoFisica' => 'NULL','created_at' => '2019-11-29 12:10:44.407','updated_at' => '2019-12-12 13:49:04.950',]);
        DB::table('TBL_EMPREGADOS')->insert(['matricula' => 'c141203','nomeCompleto' => 'MARCOS ABRAO MARCELLO','primeiroNome' => 'MARCOS','dataNascimento' => 'NULL','codigoFuncao' => '2056','nomeFuncao' => 'ASSISTENTE JUNIOR','codigoLotacaoAdministrativa' => '7257','nomeLotacaoAdministrativa' => 'GI ALIENAR BENS MOVEIS IMOV SAO PAULO,SP','codigoLotacaoFisica' => 'NULL','nomeLotacaoFisica' => 'NULL','created_at' => '2019-12-17 15:37:44.927','updated_at' => '2019-12-17 15:37:44.927',]);
        DB::table('TBL_EMPREGADOS')->insert(['matricula' => 'c116299','nomeCompleto' => 'CLEBER EDUARDO MARTINS CADA','primeiroNome' => 'CLEBER','dataNascimento' => '1984-12-09','codigoFuncao' => 'NULL','nomeFuncao' => 'GER RELACIONAMENTO PF','codigoLotacaoAdministrativa' => '1351','nomeLotacaoAdministrativa' => 'AG. ROCHDALE, SP','codigoLotacaoFisica' => 'NULL','nomeLotacaoFisica' => 'NULL','created_at' => '2019-11-29 12:10:44.407','updated_at' => '2019-12-12 13:49:04.950',]);
        DB::table('TBL_EMPREGADOS')->insert(['matricula' => 'c084794','nomeCompleto' => 'ALEXANDRE PIRES GONTIJO','primeiroNome' => 'ALEXANDRE','dataNascimento' => 'NULL','codigoFuncao' => '2056','nomeFuncao' => 'CONSULTOR MATRIZ','codigoLotacaoAdministrativa' => '5530','nomeLotacaoAdministrativa' => 'GN INFRAESTRUTURA E PATRIM DE TERCEIROS','codigoLotacaoFisica' => 'NULL','nomeLotacaoFisica' => 'NULL','created_at' => '2019-12-17 15:37:44.927','updated_at' => '2019-12-17 15:37:44.927',]);
        DB::table('TBL_EMPREGADOS')->insert(['matricula' => 'c090120','nomeCompleto' => 'MARCELO BARBOZA FERNANDES','primeiroNome' => 'MARCELO','dataNascimento' => '1982-05-02','codigoFuncao' => '2066','nomeFuncao' => 'GERENTE DE FILIAL','codigoLotacaoAdministrativa' => '7257','nomeLotacaoAdministrativa' => 'GI ALIENAR BENS MOVEIS IMOV SAO PAULO,SP','codigoLotacaoFisica' => 'NULL','nomeLotacaoFisica' => 'NULL','created_at' => '2020-02-11 12:04:46.710','updated_at' => '2020-02-11 12:04:46.710', 'cpf' => '22629697878',]);
    }
}
