<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Setting;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run():void
    {
        Setting::factory()->create();

        $this->seedUsers();
        $this->call(
            [
                UnitTypeSeeder::class,
                ToothTypeSeeder::class,
                ExpenseTypeSeeder::class,
                ColorSeeder::class,
            ]
        );
    }

    /**
     * Seed the users database.
     *
     * @return void
     */
    private function seedUsers():void
    {
        $user = User::where('email','test@example.com');
        if(!isset($user)){
            User::firstOrCreate([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password')
            ]);
        }
    }
}
