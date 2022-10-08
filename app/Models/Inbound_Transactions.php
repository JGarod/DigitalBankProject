<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Inbound_Transactions extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'inbound_amount',
        'receive_wallet_id',
    ];

    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }
}
