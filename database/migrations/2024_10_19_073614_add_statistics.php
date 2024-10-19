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
        Schema::table('channels', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('watch_time')->default(0);
            $table->dateTime('last_viewed_at')->nullable();
        });

        Schema::table('video_files', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('watch_time')->default(0);
            $table->dateTime('last_viewed_at')->nullable();
        });

        Schema::table('tv_shows', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('watch_time')->default(0);
            $table->dateTime('last_viewed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('channels', function (Blueprint $table) {
            $table->dropColumn([
                'views',
                'watch_time',
                'last_viewed_at',
            ]);
        });

        Schema::table('video_files', function (Blueprint $table) {
            $table->dropColumn([
                'views',
                'watch_time',
                'last_viewed_at',
            ]);
        });

        Schema::table('tv_shows', function (Blueprint $table) {
            $table->dropColumn([
                'views',
                'watch_time',
                'last_viewed_at',
            ]);
        });
    }
};
