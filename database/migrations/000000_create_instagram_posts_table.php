<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instagram_posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('instagram_user_id');
            $table->integer('instagram_id')->unique();
            $table->timestamp('timestamp');
            $table->timestamp('caption')->nullable();
            $table->timestamp('permalink');
            $table->string('media_type');
            $table->string('media_url');
            $table->string('thumbnail_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instagram_posts');
    }
};
