<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'email' => 'guilherme@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Guilherme8593_8593')
        ]);
    }
}
