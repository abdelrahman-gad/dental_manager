<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Doctor;
use App\Models\Order;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure required related data exists
        if (Doctor::count() === 0 || Order::count() === 0) {
            $this->command->warn('⚠️ Please seed DoctorSeeder and OrderSeeder before running InvoiceSeeder.');
            return;
        }

        $doctorIds = Doctor::pluck('id')->toArray();
        $orderIds  = Order::pluck('id')->toArray();

        $invoices = [
            [
                'discount_type' => 'PERCENTAGE',
                'discount_value' => 10,
                'discount_amount' => 150.00,
                'subtotal_amount' => 1500.00,
                'total_amount' => 1350.00,
                'paid_amount' => 0.00,
                'remaining_amount' => 1350.00,
                'payment_status' => 'UNPAID',
                'doctor_id' => $doctorIds[array_rand($doctorIds)],
                'order_id' => $orderIds[array_rand($orderIds)],
                'notes' => 'Initial order for crowns and veneers.',
            ],
            [
                'discount_type' => 'FIXED',
                'discount_value' => 200.00,
                'discount_amount' => 200.00,
                'subtotal_amount' => 1200.00,
                'total_amount' => 1000.00,
                'paid_amount' => 500.00,
                'remaining_amount' => 500.00,
                'payment_status' => 'UNPAID',
                'doctor_id' => $doctorIds[array_rand($doctorIds)],
                'order_id' => $orderIds[array_rand($orderIds)],
                'notes' => 'Partial payment received for zirconia cases.',
            ],
            [
                'discount_type' => null,
                'discount_value' => null,
                'discount_amount' => 0.00,
                'subtotal_amount' => 800.00,
                'total_amount' => 800.00,
                'paid_amount' => 800.00,
                'remaining_amount' => 0.00,
                'payment_status' => 'PAID',
                'doctor_id' => $doctorIds[array_rand($doctorIds)],
                'order_id' => $orderIds[array_rand($orderIds)],
                'notes' => 'Full payment for composite fillings.',
            ],
            [
                'discount_type' => 'PERCENTAGE',
                'discount_value' => 5,
                'discount_amount' => 75.00,
                'subtotal_amount' => 1500.00,
                'total_amount' => 1425.00,
                'paid_amount' => 1000.00,
                'remaining_amount' => 425.00,
                'payment_status' => 'UNPAID',
                'doctor_id' => $doctorIds[array_rand($doctorIds)],
                'order_id' => $orderIds[array_rand($orderIds)],
                'notes' => 'Discount for loyal client order.',
            ],
            [
                'discount_type' => 'FIXED',
                'discount_value' => 100.00,
                'discount_amount' => 100.00,
                'subtotal_amount' => 1000.00,
                'total_amount' => 900.00,
                'paid_amount' => 900.00,
                'remaining_amount' => 0.00,
                'payment_status' => 'PAID',
                'doctor_id' => $doctorIds[array_rand($doctorIds)],
                'order_id' => $orderIds[array_rand($orderIds)],
                'notes' => 'Invoice settled on delivery.',
            ],
        ];

        foreach ($invoices as $invoice) {
            Invoice::create($invoice);
        }
    }
}
