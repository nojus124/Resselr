<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemConditions extends Model
{
    protected $table = 'itemconditions';
    protected $primaryKey = 'id';
    use HasFactory;
    protected $fillable = [
        'Condition',
    ];
}
