<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model {
    protected $fillable = [
        'user_id','vehicle_id','start_at','end_at','delivery_mode','delivery_address',
        'status','estimated_total','final_total'
    ];
    protected $casts = ['start_at'=>'datetime','end_at'=>'datetime'];

    public function user(){ return $this->belongsTo(User::class); }
    public function vehicle(){ return $this->belongsTo(Vehicle::class); }
    public function payment(){ return $this->hasOne(Payment::class); }
    public function hours(): int { return Carbon::parse($this->start_at)->diffInHours(Carbon::parse($this->end_at)); }
}
