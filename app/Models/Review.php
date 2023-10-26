<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'TransactionID',
        'Rate',
        'Description',
    ];
    protected $primaryKey = 'id';

    public function transaction()
    {
        return $this->belongsTo(Transactions::class, 'TransactionID');
    }
}
