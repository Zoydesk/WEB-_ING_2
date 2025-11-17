<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::table('reservations', function(Blueprint $t){
      $t->unsignedTinyInteger('rating')->nullable(); // 1..5
      $t->text('rating_comment')->nullable();
    });
  }
  public function down(): void {
    Schema::table('reservations', function(Blueprint $t){
      $t->dropColumn(['rating','rating_comment']);
    });
  }
};
