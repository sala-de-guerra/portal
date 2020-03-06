<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {    
        if (env('APP_ENV') == 'local') {
            $this->call([
                EmpregadosTableSeeder::class,
                DistratoDemandasTableSeeder::class,
                PerfisAcessoPortalTableSeeder::class,
            ]);
        }
        $this->call([
            GestaoEquipesCelulasTableSeeder::class,
        ]);
    }
}
