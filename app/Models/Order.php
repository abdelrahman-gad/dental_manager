<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $guarded = [];
    
    protected $casts = [
        'delivered'=> 'boolean'
    ];
    public function doctor():BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function invoice():HasOne
    {
        return $this->hasOne(Invoice::class);
    }
    public function color():BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
    public function toothType():BelongsTo
    {
        return $this->belongsTo(ToothType::class);
    }
    public function units():HasMany
    {
        return $this->hasMany(Unit::class);
    }
}
