<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class CreateSuperUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mirjalol',
            'email' => 'mirjalol2401@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
