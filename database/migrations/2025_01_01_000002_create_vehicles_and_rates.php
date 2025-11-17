<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('vehicles', function(Blueprint $t){
      $t->id();
      $t->string('name');
      $t->string('brand');
      $t->string('category'); // SCOOTER_ELECTRICO|BICI|MOTO_ELECTRICA|PATINES
      $t->text('description')->nullable();
      $t->string('image')->nullable();
      $t->enum('status',['AVAILABLE','IN_RENT','MAINTENANCE'])->default('AVAILABLE');
      $t->unsignedInteger('stock')->default(3); // NUEVO
      $t->timestamps();
    });
    Schema::create('rates', function(Blueprint $t){
      $t->id();
      $t->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
      $t->decimal('hour_price',10,2);
      $t->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('rates');
    Schema::dropIfExists('vehicles');
  }
};
