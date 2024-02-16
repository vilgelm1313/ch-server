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
            $table->unsignedBigInteger('epg_setting_id')->nullable();
            $table->foreign('epg_setting_id')
                ->references('id')
                ->on('epg_settings')
                ->onDelete('restrict');
        });

        Schema::create('channels_epg_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('channel_id');
            $table->unsignedBigInteger('epg_setting_id');
            $table->timestamps();

            $table->foreign('channel_id')
                ->references('id')
                ->on('channels')
                ->onDelete('cascade');

            $table->foreign('epg_setting_id')
                ->references('id')
                ->on('epg_settings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('channels', function (Blueprint $table) {
            $table->dropForeign('channels_epg_setting_id_foreign');
            $table->dropColumn('epg_setting_id');
        });
        Schema::dropIfExists('channels_epg_settings');
    }
};
