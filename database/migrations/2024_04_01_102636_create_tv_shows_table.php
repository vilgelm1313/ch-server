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
        Schema::create('tv_shows', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('original_title')->nullable();
            $table->string('comment')->nullable();
            $table->string('poster')->nullable();
            $table->date('show_start');
            $table->date('show_end');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('tv_show_seasons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('is_active')->default(true);
            $table->json('episodes')->nullable();
            $table->unsignedBigInteger('tv_show_id');
            $table->timestamps();

            $table->foreign('tv_show_id')
                ->references('id')
                ->on('tv_shows')
                ->onDelete('cascade');
        });

        Schema::create('tv_show_server', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id');
            $table->unsignedBigInteger('tv_show_id');
            $table->date('synced_at')->nullable();
            $table->timestamps();

            $table->foreign('server_id')
                ->references('id')
                ->on('servers')
                ->onDelete('cascade');

            $table->foreign('tv_show_id')
                ->references('id')
                ->on('tv_shows')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_show_server');
        Schema::dropIfExists('tv_show_seasons');
        Schema::dropIfExists('tv_shows');
    }
};
