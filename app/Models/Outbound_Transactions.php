<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Outbound_Transactions extends Model
{
    use HasFactory, softDeletes;
    protected $fillable =[
        'receive_wallet_id',
        'send_wallet_id',
        'outbound_amount'
    ];

    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }
}
