<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transaction():HasOne
    {
        return $this->hasOne(Transaction::class);
    }

    public function order():BelongsTo
    {
     return $this->belongsTo(Order::class);         
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
