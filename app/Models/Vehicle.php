<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['name', 'brand', 'category', 'description', 'image', 'status'];
    public function rate()
    {
        return $this->hasOne(Rate::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'SCOOTER_ELECTRICO' => 'Scooter eléctrico',
            'BICI' => 'Bicicleta',
            'MOTO_ELECTRICA' => 'Moto eléctrica',
            'PATINES' => 'Patines',
            default => $this->category,
        };
    }
}
