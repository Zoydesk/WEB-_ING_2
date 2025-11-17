<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, Vehicle, Rate};

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    User::factory()->create(['name' => 'Admin', 'email' => 'admin@demo.test', 'password' => Hash::make('secret123'), 'role' => 'admin']);
    User::factory()->create(['name' => 'Trabajador', 'email' => 'worker@demo.test', 'password' => Hash::make('secret123'), 'role' => 'worker']);
    User::factory()->create(['name' => 'Cliente', 'email' => 'user@demo.test', 'password' => Hash::make('secret123'), 'role' => 'customer']);

    $items = [
      ['name' => 'Scooter City X', 'brand' => 'EcoMove', 'category' => 'SCOOTER_ELECTRICO', 'description' => 'Patineta eléctrica urbana, 35 km autonomía'],
      ['name' => 'Bici Urbana Pro', 'brand' => 'GreenRide', 'category' => 'BICI', 'description' => 'Bicicleta de ciudad con 8 velocidades'],
      ['name' => 'Moto E Commuter', 'brand' => 'VoltMoto', 'category' => 'MOTO_ELECTRICA', 'description' => 'Moto eléctrica 4kW, 80 km/h'],
      ['name' => 'Patines E Glide', 'brand' => 'FlowSkate', 'category' => 'PATINES', 'description' => 'Patines eléctricos ligeros, 18 km autonomía'],
    ];
    foreach ($items as $c) {
      $v = Vehicle::create($c + ['stock' => rand(2, 6)]);
      Rate::create(['vehicle_id' => $v->id, 'hour_price' => rand(4, 12)]);
    }
  }
}
