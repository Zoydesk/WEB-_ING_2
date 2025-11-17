<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::table('vehicles', function(Blueprint $t){
      $t->unsignedInteger('stock')->default(3)->after('status'); // número de unidades
    });
  }
  public function down(): void {
    Schema::table('vehicles', function(Blueprint $t){
      $t->dropColumn('stock');
    });
  }
};
