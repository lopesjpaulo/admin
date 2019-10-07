<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Maxmeio',
            'email' => 'maxmeio@maxmeio.com',
            'password' => bcrypt('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Carlos',
            'email' => 'carlos@maxmeio.com',
            'password' => bcrypt('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}