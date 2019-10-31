<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('modules')->delete();

        DB::table('modules')->insert([
            [
                'title' => 'Usuarios',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Grupos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Modulos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Usuarios',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
