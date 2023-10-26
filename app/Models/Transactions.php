<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'BuyerID',
        'SellerID',
        'ItemID',
        'TransactionDate',
        'TransactionStatus',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'ItemID');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'TransactionID');
    }
}
