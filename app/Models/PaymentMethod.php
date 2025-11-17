<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {
    protected $fillable=['user_id','brand','last4','token'];
    public function user(){ return $this->belongsTo(User::class); }
}
