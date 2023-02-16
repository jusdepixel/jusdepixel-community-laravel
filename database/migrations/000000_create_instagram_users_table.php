<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instagram_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('ig_id')->unique();
            $table->timestamp('timestamp');
            $table->string('username');
            $table->integer('media_count');
            $table->string('token');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instagram_users');
    }
};
