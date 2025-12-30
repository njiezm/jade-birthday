<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dotations', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('name');
            $table->string('email');
            $table->decimal('amount', 8, 2);
            $table->text('message')->nullable();
            $table->string('type'); // contribution, bottle, music, photoshoot
            $table->string('status')->default('pending'); // pending, paid, cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dotations');
    }
};