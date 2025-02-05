<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory,SoftDeletes;
    protected  $guarded = [];
    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }
    
    public function invoices():HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
