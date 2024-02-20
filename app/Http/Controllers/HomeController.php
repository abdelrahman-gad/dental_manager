<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Doctor;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Unit;

use function Ramsey\Uuid\v1;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getStatistics()
    {

        $stats = [];
        // Orders Count
        $totalOrdersCount = Order::count();
        //Delivered Orderd
        $totalDeliveredCount  = Order::where('delivered', 1)->count();
        //Undeliverd Orders
        $totalUndileveredCount  = Order::where('delivered', 0)->count();

        //Total Units
        $totalUnitsCount = Unit::count();
        //Delivered Units
        $totalDeliveredCount = Unit::whereHas('order',function($q){
            $q->where('delivered',1);
        })->count();
        //Undelivered Units

        $totalUndeliveredCount = Unit::whereHas('order',function($q){
            $q->where('delivered',0);
        })->count();

        //Total Invocies Count : Money ,
        $totalInvoicesCount = Invoice::count();
        $totalInvoicesAmount = Invoice::sum('total_amount');
        // Paid Invocies Count ,
        $totalPaidInvoicesCount = Invoice::where('payment_status','PAID')->count();
        $totalPaidInvoicesAmount = Invoice::sum('paid_amount');

        // Unpaid Invoices Count,

        $totalUnPaidInvoicesCount = Invoice::where('payment_status','PAID')->count();
        $totalUnPaidInvoicesAmount = Invoice::sum('paid_amount');

        $assetsCount = Asset::count();
        $assetsAmount = Asset::sum('cost');

        $doctorsCounts = Doctor::count();
        $expensesCount = Expense::count();
        $expensesAmount = Expense::sum('cost');

        $stats = [
            [
                'name' => 'Orders',
                'name_ar'=>'الحالات',
                'value' => $totalOrdersCount,
            ],
            [
                'name_ar'=>'الحالات التي تم تسليمها',

                'name' => 'Delivered Orders',
                'value' => $totalDeliveredCount,
            ],
            [
                'name_ar'=>'الحالات التي لم يتم توصيلها',

                'name' => 'Undilvered Orders',
                'value' => $totalUndileveredCount,
            ],
            [
                'name_ar'=>'الوحدات',

                'name' => 'Units ',
                'value' => $totalUnitsCount,
            ],
            [
                'name_ar'=>'الوحدات التي تم توصيلها',

                'name' => 'Delivered Units',
                'value' => $totalOrdersCount,
            ],
            [
                'name_ar'=>'الوحدات التي لم يتم توصيلها',

                'name' => 'Undilevered Units',
                'value' => $totalUndeliveredCount,
            ],
            [
                'name_ar'=>'عدد الفواتير  ',

                'name' => 'Invoices ',
                'value' => $totalInvoicesCount,
            ],

            [
                'name_ar'=>'مجموع قيمة الفواتير',

                'name' => 'Invoices Amount ',
                'value' => $totalInvoicesAmount,
            ],

            [
                'name_ar'=>'عدد الفواتير التي تم دفعها',

                'name' => 'Paid Invoices',
                'value' => $totalPaidInvoicesCount,
            ],
            [
                'name_ar'=>'مجموع قيمة الفواتير التي تم دفعها',
                'name' => 'Paid Invoices Amount',
                'value' => $totalPaidInvoicesAmount,
            ],

            [
                'name_ar'=>'الفواتير التي لم يتم دفعها',
                'name' => 'Unpaid Invoices Count',
                'value' => $totalUnPaidInvoicesCount,
            ],
            [
                'name_ar'=>'مجموع قيمة الفواتير التي لم يتم دفعها',
                'name' => 'Unpaid Invoice Amount',
                'value' => $totalUnPaidInvoicesAmount,
            ],

            [
                'name_ar'=>'الأصول الثابتة',
                'name' => 'Assets Count',
                'value' => $assetsCount,
            ],
            [
                'name_ar'=>'مجموع قيمة الأصول الثابتة',
                'name' => 'Assets Amount',
                'value' => $assetsAmount,
            ],
            [
                'name' => 'Doctors',
                'name_ar'=>'الأطباء',
                'value' => $doctorsCounts,
            ],
            [
                'name_ar'=>'عدد النفقات',
                'name' => 'Expenses Count',
                'value' => $expensesCount,
            ],
            [
                'name_ar'=>'مجموع قيمة النفقات',
                'name' => 'Expenses Amount',
                'value' => $expensesAmount,
            ],
        ];
        return response()->json(['message' => '', 'data' => $stats], 200);
    }

}
