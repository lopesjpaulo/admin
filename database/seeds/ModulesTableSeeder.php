<?php

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create([
            'title' => 'news',
            'description' => 'Módulo de notícias',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
