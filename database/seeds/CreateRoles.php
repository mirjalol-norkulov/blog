<?php

use App\Models\Auth\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            Role::create([
                'name' => 'admin',
                'display_name' => 'Administrator'
            ]);

            Role::create([
                'name' => 'author',
                'display_name' => 'Author'
            ]);

            Role::create([
                'name' => 'user',
                'display_name' => 'User'
            ]);
        });
    }
}
