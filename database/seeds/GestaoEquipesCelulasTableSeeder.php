<?php

use Illuminate\Database\Seeder;

class GestaoEquipesCelulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_GESTAO_EQUIPES_CELULAS')->truncate();

        DB::table('TBL_GESTAO_EQUIPES_CELULAS')->insert([
            'nomeEquipe'            => 'ALOCAR EMPREGADOS',
            'created_at'            => '2020-03-04 15:30:00.000',
            'updated_at'            => '2020-03-04 15:30:00.000',
        ]);
    }
}
