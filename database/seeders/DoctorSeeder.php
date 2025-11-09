<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Dr. Ahmed Abdelhady',
                'email' => 'ahmed.abdelhady@example.com',
                'phone' => '+201000000001',
                'whatsapp' => '+201000000001',
                'address' => '123 Nile Street, Cairo, Egypt',
            ],
            [
                'name' => 'Dr. Sarah Hassan',
                'email' => 'sarah.hassan@example.com',
                'phone' => '+201000000002',
                'whatsapp' => '+201000000002',
                'address' => '45 Zamalek Ave, Cairo, Egypt',
            ],
            [
                'name' => 'Dr. Mohamed Fathy',
                'email' => 'mohamed.fathy@example.com',
                'phone' => '+201000000003',
                'whatsapp' => '+201000000003',
                'address' => '21 Alexandria Road, Giza, Egypt',
            ],
            [
                'name' => 'Dr. Lina Youssef',
                'email' => 'lina.youssef@example.com',
                'phone' => '+201000000004',
                'whatsapp' => '+201000000004',
                'address' => '78 Downtown St, Tanta, Egypt',
            ],
            [
                'name' => 'Dr. Omar Farouk',
                'email' => 'omar.farouk@example.com',
                'phone' => '+201000000005',
                'whatsapp' => '+201000000005',
                'address' => '56 October City, Cairo, Egypt',
            ],
            [
                'name' => 'Dr. Hala Mahmoud',
                'email' => 'hala.mahmoud@example.com',
                'phone' => '+201000000006',
                'whatsapp' => '+201000000006',
                'address' => '9 El Maadi Street, Cairo, Egypt',
            ],
            [
                'name' => 'Dr. Karim Soliman',
                'email' => 'karim.soliman@example.com',
                'phone' => '+201000000007',
                'whatsapp' => '+201000000007',
                'address' => '11 Corniche Rd, Alexandria, Egypt',
            ],
            [
                'name' => 'Dr. Yasmin Mostafa',
                'email' => 'yasmin.mostafa@example.com',
                'phone' => '+201000000008',
                'whatsapp' => '+201000000008',
                'address' => '33 Mansoura Center, Dakahlia, Egypt',
            ],
            [
                'name' => 'Dr. Ali Nasser',
                'email' => 'ali.nasser@example.com',
                'phone' => '+201000000009',
                'whatsapp' => '+201000000009',
                'address' => '77 Sohag Street, Sohag, Egypt',
            ],
            [
                'name' => 'Dr. Salma Ezzat',
                'email' => 'salma.ezzat@example.com',
                'phone' => '+201000000010',
                'whatsapp' => '+201000000010',
                'address' => '5 Luxor Avenue, Luxor, Egypt',
            ],
        ];

        foreach ($doctors as $doctor) {
            $doctorEntity = Doctor::where('email', $doctor['email'])->first();
            if(!isset($doctorEntity)) {
                Doctor::create(
                    [
                        'phone' => $doctor['phone'],
                        'name' => $doctor['name'],
                        'email' => $doctor['email'],
                        'whatsapp' => $doctor['whatsapp'],
                        'address' => $doctor['address'],
                    ]
                );
            }
        }
    }
}
