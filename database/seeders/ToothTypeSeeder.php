<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ToothType;

class ToothTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toothTypes = [
            [
                'name' => 'Porcelain Crown',
                'description' => 'Aesthetic and durable crown made from porcelain material.',
                'cost' => 250.00,
            ],
            [
                'name' => 'Zirconia Crown',
                'description' => 'Strong and biocompatible crown with natural appearance.',
                'cost' => 300.00,
            ],
            [
                'name' => 'Composite Filling',
                'description' => 'Tooth-colored resin material for filling cavities.',
                'cost' => 90.00,
            ],
            [
                'name' => 'Amalgam Filling',
                'description' => 'Traditional silver-colored metal filling.',
                'cost' => 70.00,
            ],
            [
                'name' => 'Gold Crown',
                'description' => 'Premium crown made of gold alloy, known for longevity.',
                'cost' => 450.00,
            ],
            [
                'name' => 'Ceramic Veneer',
                'description' => 'Thin ceramic covering for front teeth, improves aesthetics.',
                'cost' => 220.00,
            ],
            [
                'name' => 'Acrylic Denture',
                'description' => 'Removable denture made from acrylic resin.',
                'cost' => 180.00,
            ],
            [
                'name' => 'Metal Framework Denture',
                'description' => 'Durable partial denture with metal framework.',
                'cost' => 280.00,
            ],
            [
                'name' => 'Resin Inlay',
                'description' => 'Resin-based inlay for restoring moderate decay.',
                'cost' => 150.00,
            ],
            [
                'name' => 'Ceramic Inlay',
                'description' => 'High-strength inlay made of ceramic for durability.',
                'cost' => 200.00,
            ],
        ];

        foreach ($toothTypes as $type) {
           $toothType = ToothType::where(
              [ 'name' => $type['name']] // avoid duplicates
            )->first();
           if (!isset($toothType)) {
               ToothType::create([
                   'name' => $type['name'],
                   'description' => $type['description'],
                   'cost' => $type['cost'],
               ]);
           }
        }
    }
}
