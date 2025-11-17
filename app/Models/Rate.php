<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {
  protected $fillable=['vehicle_id','hour_price'];
  public function vehicle(){ return $this->belongsTo(Vehicle::class); }
}
