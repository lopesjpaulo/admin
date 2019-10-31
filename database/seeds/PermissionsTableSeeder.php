<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        DB::table('permissions')->insert([
            [
                'title' => 'read_usuarios',
                'module_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'create_usuarios',
                'module_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'update_usuarios',
                'module_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'delete_usuarios',
                'module_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'read_grupos',
                'module_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'create_grupos',
                'module_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'update_grupos',
                'module_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'delete_grupos',
                'module_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'read_modulos',
                'module_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'create_modulos',
                'module_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'update_modulos',
                'module_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'delete_modulos',
                'module_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'read_usuarios',
                'module_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'create_usuarios',
                'module_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'update_usuarios',
                'module_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'delete_usuarios',
                'module_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
