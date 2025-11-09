<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assets = [
            [
                'name' => 'Dental Chair',
                'cost' => 15000.00,
                'notes' => 'Main treatment chair with full hydraulic control.',
            ],
            [
                'name' => 'X-Ray Machine',
                'cost' => 12000.00,
                'notes' => 'Digital panoramic X-ray system.',
            ],
            [
                'name' => 'Sterilization Unit',
                'cost' => 8000.00,
                'notes' => 'Autoclave for instrument sterilization.',
            ],
            [
                'name' => 'Compressor',
                'cost' => 4000.00,
                'notes' => 'Silent air compressor for dental units.',
            ],
            [
                'name' => 'Dental Handpieces Set',
                'cost' => 2500.00,
                'notes' => 'High and low-speed handpieces for daily use.',
            ],
            [
                'name' => 'LED Curing Light',
                'cost' => 600.00,
                'notes' => 'Wireless curing light for resin materials.',
            ],
            [
                'name' => 'Ultrasonic Scaler',
                'cost' => 1200.00,
                'notes' => 'Used for dental cleaning and scaling procedures.',
            ],
            [
                'name' => 'Dental Cabinet',
                'cost' => 3000.00,
                'notes' => 'Storage cabinet for tools and materials.',
            ],
            [
                'name' => 'Computer System',
                'cost' => 2000.00,
                'notes' => 'Clinic management system and patient records.',
            ],
            [
                'name' => 'Intraoral Camera',
                'cost' => 900.00,
                'notes' => 'High-resolution camera for patient education.',
            ],
        ];

        foreach ($assets as $asset) {
            $assetEntity = Asset::where(['name' => $asset['name']])->first();
            if(!isset($assetEntity)) {
                Asset::create(
                    [
                        'name' => $asset['name'],
                        'cost' => $asset['cost'],
                        'notes' => $asset['notes'],
                    ]
                );
            }

        }
    }
}
