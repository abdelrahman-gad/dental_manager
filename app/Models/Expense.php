<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded =[];
    public function expenseType():BelongsTo
    {
        return $this->belongsTo(ExpenseType::class);
    }
    public function transaction():HasOne{
        return $this->hasOne(Transaction::class);
    }
}
