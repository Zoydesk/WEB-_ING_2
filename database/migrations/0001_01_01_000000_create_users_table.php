<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('email')->unique();
            $t->string('password');
            $t->string('phone')->nullable();
            $t->string('role')->default('customer'); // admin|worker|customer
            $t->rememberToken();
            $t->timestamps();
            $t->timestamp('email_verified_at')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('users'); }
};
