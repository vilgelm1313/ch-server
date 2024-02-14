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
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('smartiptv')->nullable();
            $table->integer('index')->default(9999);
            $table->string('url')->nullable();
            $table->smallInteger('dvr')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_external')->default(false);
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
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
