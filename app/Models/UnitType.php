<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    use HasFactory;
    protected  $guarded = [];
    public const DIRECTION_LEFT = 'LEFT';
    public const DIRECTION_RIGHT = 'RIGHT';
    public const LEVEL_UPPER = 'UPPER';
    public const LEVEL_LOWER = 'LOWER';

}
