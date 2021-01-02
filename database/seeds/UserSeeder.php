<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\User::create([
            'f_name' =>'admin',
            'm_name' => 'admin',
            'l_name' => 'admin',
            'user_id' =>'admin',
            'password' => Hash::make('admin'),
        ]);
    }
}
