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
        User::create(
            [
                'name' => 'lucas castro',
                'email' => 'lucas.castro1993@hotmail.com',
                'password' => Hash::make('123456'),
            ]
        );
    }
}
