<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('video_files', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('poster');
            $table->string('title');
            $table->string('original_title')->nullable();
            $table->string('kinopoisk_url')->nullable();
            $table->float('imbd')->nullable();
            $table->float('kinopoisk')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('show_start');
            $table->date('show_end');
            $table->integer('year')->nullable();
            $table->string('country')->nullable();
            $table->string('director')->nullable();
            $table->text('actors')->nullable();
            $table->text('genres')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_files');
    }
};
