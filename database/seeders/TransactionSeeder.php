<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Expense;
use App\Models\Invoice;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Expense::count() === 0 && Invoice::count() === 0) {
            $this->command->warn('⚠️ No Expenses or Invoices found. Please seed ExpenseSeeder and InvoiceSeeder first.');
            return;
        }

        $expenseIds = Expense::pluck('id')->toArray();
        $invoiceIds = Invoice::pluck('id')->toArray();

        $transactions = [];

        // 5 Expense transactions
        for ($i = 0; $i < 5 && !empty($expenseIds); $i++) {
            $transactions[] = [
                'type' => 'EXPENSE',
                'expense_id' => $expenseIds[array_rand($expenseIds)],
                'invoice_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // 5 Invoice transactions
        for ($i = 0; $i < 5 && !empty($invoiceIds); $i++) {
            $transactions[] = [
                'type' => 'INVOICE',
                'expense_id' => null,
                'invoice_id' => $invoiceIds[array_rand($invoiceIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }
}
