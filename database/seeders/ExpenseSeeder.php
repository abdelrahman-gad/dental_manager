<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\ExpenseType;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have some expense types
        if (ExpenseType::count() === 0) {
            $this->command->warn('⚠️ No expense types found. Please seed ExpenseTypeSeeder first.');
            return;
        }

        // Fetch all existing expense type IDs
        $expenseTypeIds = ExpenseType::pluck('id')->toArray();

        $expenses = [
            [
                'notes' => 'Purchased new dental materials for fillings and crowns.',
                'expense_type_id' => $expenseTypeIds[array_rand($expenseTypeIds)],
                'cost' => 1250.00,
            ],
            [
                'notes' => 'Monthly electricity and water bills.',
                'expense_type_id' => $expenseTypeIds[array_rand($expenseTypeIds)],
                'cost' => 800.00,
            ],
            [
                'notes' => 'Employee salaries for the month.',
                'expense_type_id' => $expenseTypeIds[array_rand($expenseTypeIds)],
                'cost' => 6500.00,
            ],
            [
                'notes' => 'Routine maintenance for dental chairs.',
                'expense_type_id' => $expenseTypeIds[array_rand($expenseTypeIds)],
                'cost' => 500.00,
            ],
            [
                'notes' => 'Office stationery and supplies restock.',
                'expense_type_id' => $expenseTypeIds[array_rand($expenseTypeIds)],
                'cost' => 300.00,
            ],
            [
                'notes' => 'Google Ads campaign for clinic promotion.',
                'expense_type_id' => $expenseTypeIds[array_rand($expenseTypeIds)],
                'cost' => 200.00,
            ],
            [
                'notes' => 'Monthly building rent payment.',
                'expense_type_id' => $expenseTypeIds[array_rand($expenseTypeIds)],
                'cost' => 2500.00,
            ],
            [
                'notes' => 'Annual insurance renewal for clinic equipment.',
                'expense_type_id' => $expenseTypeIds[array_rand($expenseTypeIds)],
                'cost' => 1200.00,
            ],
            [
                'notes' => 'Dental lab service fees for patient cases.',
                'expense_type_id' => $expenseTypeIds[array_rand($expenseTypeIds)],
                'cost' => 900.00,
            ],
            [
                'notes' => 'Software subscriptions for clinic management system.',
                'expense_type_id' => $expenseTypeIds[array_rand($expenseTypeIds)],
                'cost' => 400.00,
            ],
        ];

        foreach ($expenses as $expense) {
            Expense::create($expense);
        }
    }
}
