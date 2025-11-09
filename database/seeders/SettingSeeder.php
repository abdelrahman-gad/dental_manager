<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use App\Models\Color;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = Setting::where('name','Kemit')->first();

        if(!isset($setting)){
            Setting::create([
                'name' => 'Kemit',
                'phone'=>'012424242',
                'whatsapp'=>'012424242',
                'notes'=>'Kemit',
            ]);
        }
    }
}
