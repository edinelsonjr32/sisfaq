<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador 1',
            'email' => 'admin@sisfaq.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
