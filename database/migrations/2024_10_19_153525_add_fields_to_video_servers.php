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
        Schema::table('video_servers', function (Blueprint $table) {
            $table->string('apk_version')->nullable();
            $table->string('apk_src')->nullable();
            $table->string('apk_changes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('video_servers', function (Blueprint $table) {
            $table->dropColumn([
                'apk_version',
                'apk_src',
                'apk_changes',
            ]);
        });
    }
};
