<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExpenseType;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenseTypes = [
            [
                'name' => 'Dental Materials',
                'description' => 'Expenses for dental supplies and consumables like fillings, crowns, etc.',
            ],
            [
                'name' => 'Lab Fees',
                'description' => 'Payments made to external dental labs for fabrications and tests.',
            ],
            [
                'name' => 'Staff Salaries',
                'description' => 'Monthly wages for dental assistants, receptionists, and hygienists.',
            ],
            [
                'name' => 'Utilities',
                'description' => 'Electricity, water, and gas expenses for clinic operations.',
            ],
            [
                'name' => 'Maintenance',
                'description' => 'Maintenance costs for dental chairs, tools, and office equipment.',
            ],
            [
                'name' => 'Office Supplies',
                'description' => 'Stationery, printing, and general administrative supplies.',
            ],
            [
                'name' => 'Marketing & Advertising',
                'description' => 'Online ads, flyers, and promotional materials for clinic visibility.',
            ],
            [
                'name' => 'Rent',
                'description' => 'Monthly rent for clinic premises.',
            ],
            [
                'name' => 'Insurance',
                'description' => 'Insurance coverage for clinic property, equipment, and liability.',
            ],
            [
                'name' => 'Software Subscriptions',
                'description' => 'Monthly or yearly payments for digital tools like management systems or CRMs.',
            ],
        ];

        foreach ($expenseTypes as $type) {
            ExpenseType::updateOrCreate(
                ['name' => $type['name']], // Avoid duplicates
                $type
            );
        }
    }
}
