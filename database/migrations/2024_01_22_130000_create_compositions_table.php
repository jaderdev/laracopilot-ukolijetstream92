<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compositions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('lyrics');
            $table->string('audio_path');
            $table->string('video_url')->nullable();
            $table->string('isrc')->unique();
            $table->enum('status', ['pending', 'registered'])->default('pending');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compositions');
    }
};