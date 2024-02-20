<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
 
    public function index(Request $request)
    {
        
        $transactionsQuery =  Transaction::with([
            'expenses.expenseType',
            'invoices.order.doctor',
        ]);

        if($request->date_from){
            $transactionsQuery->whereDate('created_at','>=',$request->date_from);
        }

        if($request->date_to){
            $transactionsQuery->whereDate('created_at','<=',$request->date_to);
        }

        if($request->date){
            $transactionsQuery->whereDate('created_at',$request->date);
        }

        if($request->type){
            $transactionsQuery->where('type',$request->type);
        }

        $transactions = $transactionsQuery->paginate(10);

        return response()->json([
            'data'=> $transactions ,
            'message' => ''
        ],200);
    }



}
