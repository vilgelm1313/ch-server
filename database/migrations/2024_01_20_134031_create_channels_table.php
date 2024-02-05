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
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('epg_key')->nullable()->index();
            $table->string('comment')->nullable();
            $table->string('logo')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('smartiptv')->nullable();
            $table->string('ssiptv')->nullable();
            $table->integer('index')->default(9999);
            $table->unsignedBigInteger('tariff_id')->nullable();
            $table->boolean('is_test')->default(false);
            $table->string('url')->nullable();
            $table->smallInteger('dvr')->nullable();
            $table->boolean('is_hevc')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_external')->default(false);
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict');

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('restrict');

            $table->foreign('tariff_id')
                ->references('id')
                ->on('tariffs')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
