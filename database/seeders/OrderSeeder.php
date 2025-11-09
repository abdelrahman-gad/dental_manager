<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Doctor;
use App\Models\Color;
use App\Models\ToothType;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure related data exists
        if (Doctor::count() === 0 || Color::count() === 0 || ToothType::count() === 0) {
            $this->command->warn('⚠️ Missing related data. Please seed DoctorSeeder, ColorSeeder, and ToothTypeSeeder first.');
            return;
        }

        // Fetch IDs from related models
        $doctorIds = Doctor::pluck('id')->toArray();
        $colorIds = Color::pluck('id')->toArray();
        $toothTypeIds = ToothType::pluck('id')->toArray();

        $orders = [
            ['patient_name' => 'Ali Hassan'],
            ['patient_name' => 'Mona Youssef'],
            ['patient_name' => 'Omar Fathy'],
            ['patient_name' => 'Sara Nabil'],
            ['patient_name' => 'Hassan Khaled'],
            ['patient_name' => 'Reem Soliman'],
            ['patient_name' => 'Karim Ahmed'],
            ['patient_name' => 'Lina Gamal'],
            ['patient_name' => 'Nour Ayman'],
            ['patient_name' => 'Youssef Farouk'],
        ];

        foreach ($orders as $order) {
            Order::create([
                'patient_name' => $order['patient_name'],
                'doctor_id' => $doctorIds[array_rand($doctorIds)],
                'color_id' => $colorIds[array_rand($colorIds)],
                'tooth_type_id' => $toothTypeIds[array_rand($toothTypeIds)],
                'delivered' => rand(0, 1),
                'attachment' => null, // could be a random filename if needed
            ]);
        }
    }
}
