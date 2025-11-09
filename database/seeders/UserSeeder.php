<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userEntity =  User::where('email','test@example.com')->first();
        if(!isset($userEntity)){
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password')
            ]);
        }
    }
}
