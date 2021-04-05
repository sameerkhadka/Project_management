<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@hueshine.com')->first();

        if(!$user) {

            User::create([

                'name' => 'admin',

                'email' => 'admin@hueshine.com',

                'password' => Hash::make('admin123'),

                'role' => 'admin'

                
            ]);

        }

    }


}
