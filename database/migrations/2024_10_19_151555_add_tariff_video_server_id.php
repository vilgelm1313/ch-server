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
        Schema::table('tariffs', function (Blueprint $table) {
            $table->unsignedBigInteger('video_server_id')->nullable();
            $table->foreign('video_server_id')->references('id')->on('video_servers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tariffs', function (Blueprint $table) {
            $table->dropForeign('tariffs_video_server_id_foreign');
            $table->dropColumn('video_server_id');
        });
    }
};
