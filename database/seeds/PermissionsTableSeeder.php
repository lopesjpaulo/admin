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
                'title' => 'view_news',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'create_news',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'edit_news',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'delete_news',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
