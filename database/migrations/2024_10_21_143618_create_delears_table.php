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
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('password');
            $table->float('balance')->default(0);
            $table->float('iptv_price');
            $table->float('playlist_price');
            $table->boolean('is_active')->default(true);
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('video_server_id');
            $table->timestamps();

            $table->foreign('video_server_id')->references('id')->on('video_servers')->onDelete('cascade');
        });

        Schema::create('dealer_invoices', function (Blueprint $table) {
            $table->id();
            $table->float('amount')->default(0);
            $table->unsignedBigInteger('dealer_id');
            $table->timestamps();

            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealer_invoices');
        Schema::dropIfExists('dealers');
    }
};
