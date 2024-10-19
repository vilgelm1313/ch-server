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
        Schema::create('stream_servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedSmallInteger('index')->default(9999);
            $table->string('address');
            $table->unsignedSmallInteger('port')->default(501);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stream_servers');
    }
};
