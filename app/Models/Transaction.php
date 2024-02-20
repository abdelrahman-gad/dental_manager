<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function expenses(){
        return $this->belongsTo(Expense::class,'expense_id');
    }
    public function invoices(){
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
