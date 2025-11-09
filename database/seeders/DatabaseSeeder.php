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

        $this->call(
            [
                SettingSeeder::class,
                UserSeeder::class,
                UnitTypeSeeder::class,
                ToothTypeSeeder::class,
                ExpenseTypeSeeder::class,
                ColorSeeder::class,
                DoctorSeeder::class,
                AssetSeeder::class,
                ExpenseSeeder::class,
                OrderSeeder::class,
                InvoiceSeeder::class,
                TransactionSeeder::class,
            ]
        );
    }

}
