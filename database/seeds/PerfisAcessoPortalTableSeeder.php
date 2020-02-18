<?php

use Illuminate\Database\Seeder;

class PerfisAcessoPortalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_PERFIS_ACESSO_PORTAL')->insert(['matricula' => 'c111710','nivelAcesso' => 'DESENVOLVEDOR','unidade' => '7257',]);
        DB::table('TBL_PERFIS_ACESSO_PORTAL')->insert(['matricula' => 'c079436','nivelAcesso' => 'GESTOR','unidade' => '7257',]);
        DB::table('TBL_PERFIS_ACESSO_PORTAL')->insert(['matricula' => 'c116299','nivelAcesso' => 'AGENCIA','unidade' => '1351',]);
        DB::table('TBL_PERFIS_ACESSO_PORTAL')->insert(['matricula' => 'c084794','nivelAcesso' => 'MATRIZ','unidade' => '5530',]);
        DB::table('TBL_PERFIS_ACESSO_PORTAL')->insert(['matricula' => 'c142765','nivelAcesso' => 'DESENVOLVEDOR','unidade' => '7257',]);
        DB::table('TBL_PERFIS_ACESSO_PORTAL')->insert(['matricula' => 'c098453','nivelAcesso' => 'DESENVOLVEDOR','unidade' => '7257',]);
        DB::table('TBL_PERFIS_ACESSO_PORTAL')->insert(['matricula' => 'c141203','nivelAcesso' => 'GILIE','unidade' => '7257',]);
    }
}
