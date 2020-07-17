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
            'email' => 'teste@email',
            'password' => \Illuminate\Support\Facades\Hash::make('teste')
        ]);
    }
}
