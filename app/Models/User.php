<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, softDeletes;
    
    protected $fillable = [
        'NIT',
        'email',
        'password',
        'name',
        'phone']; 


   public function wallet()
   {
        return $this->hasOne(Wallet::class, 'id_user');
    }
    
}
