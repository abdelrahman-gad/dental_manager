<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function unitType():BelongsTo{
        return $this->belongsTo(UnitType::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
