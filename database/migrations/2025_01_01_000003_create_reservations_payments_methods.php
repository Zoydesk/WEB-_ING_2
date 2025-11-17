<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('reservations', function(Blueprint $t){
      $t->id();
      $t->foreignId('user_id')->constrained()->cascadeOnDelete();
      $t->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
      $t->dateTime('start_at');
      $t->dateTime('end_at');
      $t->enum('delivery_mode',['AGENCY','HOME'])->default('AGENCY');
      $t->string('delivery_address')->nullable();
      $t->enum('status',['PENDING','CONFIRMED','IN_PROGRESS','FINISHED','CANCELLED'])->default('PENDING');
      $t->decimal('estimated_total',10,2)->default(0);
      $t->decimal('final_total',10,2)->nullable();
      $t->unsignedTinyInteger('rating')->nullable(); // NUEVO
      $t->text('rating_comment')->nullable();        // NUEVO
      $t->timestamps();
    });
    Schema::create('payment_methods', function(Blueprint $t){
      $t->id();
      $t->foreignId('user_id')->constrained()->cascadeOnDelete();
      $t->string('brand');
      $t->string('last4');
      $t->string('token');
      $t->timestamps();
    });
    Schema::create('payments', function(Blueprint $t){
      $t->id();
      $t->foreignId('reservation_id')->constrained()->cascadeOnDelete();
      $t->decimal('amount',10,2);
      $t->enum('status',['PENDING','APPROVED','REJECTED'])->default('PENDING');
      $t->string('provider_intent')->nullable();
      $t->timestamps();
    });
    Schema::create('notifications', function(Blueprint $t){
      $t->id();
      $t->foreignId('user_id')->constrained()->cascadeOnDelete();
      $t->string('type');
      $t->text('content');
      $t->boolean('read')->default(false);
      $t->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('notifications');
    Schema::dropIfExists('payments');
    Schema::dropIfExists('payment_methods');
    Schema::dropIfExists('reservations');
  }
};
