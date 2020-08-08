<?php

use App\Models\Auth\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::transaction(function () {
            $user = User::create([
                'name' => 'Mirjalol',
                'email' => 'mirjalol2401@gmail.com',
                'password' => Hash::make('123456')
            ]);
            $user->attachRole('admin');
        });
    }
}
