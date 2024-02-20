<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExpenseTypeRequest;
use App\Models\ExpenseType;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        return  response()->json( ['data'=>ExpenseType::all(),'message'=>' '], 200);
    }

    public function store(CreateExpenseTypeRequest $request)
    {
        ExpenseType::create($request->all());
        return response()->json(['data'=> [],'message'=>'Created Successfully'],201);
    }

    public function update(CreateExpenseTypeRequest $request, ExpenseType $expenseType)
    {
        $expenseType->update($request->all());
        return response()->json( [ 'data'=> [], 'message' =>'Updated Successfully'],200);
    }

    public function destroy(ExpenseType $expenseType)
    {
        $expenseType->delete();
        return response()->json( ['data'=> [],'message'=>'Deleted Successfully'],200);
    }
}
