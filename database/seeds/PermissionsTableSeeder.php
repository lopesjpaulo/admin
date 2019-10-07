<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(
            [
                'title'      => 'create_news',
                'module_id'  => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        Permission::create(
            [
                'title'      => 'read_news',
                'module_id'  => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        Permission::create(
            [
                'title'      => 'update_news',
                'module_id'  => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        Permission::create(
            [
                'title'      => 'delete_news',
                'module_id'  => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
