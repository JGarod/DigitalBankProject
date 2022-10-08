<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Wallet extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'current_amount',
        'id_user'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inbound_transaction(){
        return $this->hasMany(Inbound_Transactions::class);
    }

    public function outbound_transaction(){
        return $this->hasMany(Outbound_Transactions::class);
    }
}
