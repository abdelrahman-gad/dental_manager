<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'White',        'code' => '#FFFFFF'],
            ['name' => 'Black',        'code' => '#000000'],
            ['name' => 'Red',          'code' => '#FF0000'],
            ['name' => 'Blue',         'code' => '#0000FF'],
            ['name' => 'Green',        'code' => '#008000'],
            ['name' => 'Yellow',       'code' => '#FFFF00'],
            ['name' => 'Orange',       'code' => '#FFA500'],
            ['name' => 'Purple',       'code' => '#800080'],
            ['name' => 'Gray',         'code' => '#808080'],
            ['name' => 'Pink',         'code' => '#FFC0CB'],
        ];

        foreach ($colors as $color) {

            $colorEntity = Color::where(
                ['name' => $color['name']],
                $color
            )->first();

            if(!isset($colorEntity)){
                Color::create([
                    'name' => $color['name'],
                    'code' => $color['code'],
                ]);
            }
        }
    }
}
