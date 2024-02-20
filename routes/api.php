<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register',[\App\Http\Controllers\AuthController::class,'register']);
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);

Route::get('/get-statistics',[App\Http\Controllers\HomeController::class,'getStatistics']);


Route::group(['middleware'=>['auth:sanctum']],function() {
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::resource('tooth-types',\App\Http\Controllers\ToothTypeController::class);
    Route::resource('expense-types',\App\Http\Controllers\ExpenseTypeController::class);
    Route::resource('doctors',\App\Http\Controllers\DoctorController::class);

    Route::get('unit-types',[UnitController::class,'unitTypes']);
    Route::resource('colors',ColorController::class);

    Route::post('orders-store',[OrderController::class,'store']);
    Route::post('orders-update',[OrderController::class,'update']);

    Route::get('orders',[OrderController::class,'index']);
    Route::get('orders/{id}',[OrderController::class,'show']);
    Route::delete('orders/{id}',[OrderController::class,'destroy']);
    Route::get('order-restore/{id}',[OrderController::class,'restore']);
    Route::get('order-mark-as-paid/{invoiceId}',[OrderController::class,'markAsPaid']);
    Route::get('order-mark-as-unpaid/{invoiceId}',[OrderController::class,'markAsUnPaid']);
    Route::get('order-set-delivered/{orderId}',[OrderController::class,'setDelivered']);


    Route::resource('expenses',ExpenseController::class);
    Route::get('expense-restore/{id}',[ExpenseController::class,'restore']);

    Route::get('transactions',[TransactionController::class,'index']);
    Route::get('settings',[SettingController::class,'show']);
    Route::post('settings',[SettingController::class,'update']);
    Route::resource('assets',\App\Http\Controllers\AssetController::class);

});

