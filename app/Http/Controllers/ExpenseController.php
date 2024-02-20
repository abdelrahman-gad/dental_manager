<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExpenseRequest;
use App\Http\Requests\CreateExpenseTypeRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseController extends Controller
{

    public function index(Request $request)
    {
        $expensesQuery = Expense::with(['expenseType']);
        if($request->expense_type_id){
            $expensesQuery->where('expense_type_id',$request->expense_type_id);
        }
        $expenses = $expensesQuery->paginate(10);
        return response()->json(['data'=>$expenses,'message'=>''],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateExpenseRequest $request)
    {
        $data = $request->all();
        $expense = Expense::create($data);
        Transaction::create([
            'type' => 'EXPENSE',
            'expense_id' => $expense->id
        ]);
        return response()->json([
            'data' => [],
            'message' => 'Created successfully'
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {

        $expense->update($request->all());

        $transaction = $expense->transaction;
        if(isset($transaction)){
            $expense->transaction()->update([
                'expense_id' => $expense->id
            ]);
        }

        return response()->json([
            'data'=> [],
            'message' => 'updated successfully'
        ],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
       $expense->transaction()->delete();
       $expense->delete();
       return response()->json([
            'data'=> [],
            'message' => 'deleted successfully'
        ],Response::HTTP_OK);
    }

    public function restore(int $id)
    {
       Expense::withTrashed()->where(['id'=>$id])->update(['deleted_at'=>null]);
       $expense = Expense::where(['id'=>$id])->with(['transaction'])->first();
       $expense->transaction()->restore();
       return response()->json([
            'data'=> [],
            'message' => 'restored successfully'
        ],Response::HTTP_OK);
    }
}
