<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseType\CreateExpenseTypeRequest;
use App\Http\Requests\ExpenseType\UpdateExpenseTypeRequest;
use App\Http\Requests\ExpenseType\DeleteExpenseTypeRequest;
use App\Models\ExpenseType;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        return  response()->json( ['data'=>ExpenseType::all(),'message'=>' '], 200);
    }

    public function store(CreateExpenseTypeRequest $request)
    {
        $expenseType = ExpenseType::create($request->all());

        return response()->json(['data'=> $expenseType,'message'=>'Created Successfully'],201);
    }

    public function update(UpdateExpenseTypeRequest $request, ExpenseType $expenseType)
    {
        $expenseType->update($request->all());
        return response()->json( [ 'data'=> $expenseType, 'message' =>'Updated Successfully'],200);
    }

    public function destroy(ExpenseType $expenseType)
    {
        if($this->expenseTypeIsUsedInExpenses($expenseType->id)) {
            return response()->json( ['data'=> [],'message'=>'Cannot delete this expense type because it is used in one or more orders.'],422);
        }

        $expenseType->delete();
        
        return response()->json( ['data'=> [],'message'=>'Deleted Successfully'],200);
    }

    private function expenseTypeIsUsedInExpenses($expenseTypeId)
    {
        return \App\Models\Expense::where('expense_type_id', $expenseTypeId)->exists();
    }
}
