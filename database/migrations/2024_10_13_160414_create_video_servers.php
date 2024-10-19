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
        Schema::create('video_servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(false);
            $table->string('epg_src');
            $table->string('logo_src');
            $table->boolean('mail_encryption');
            $table->string('mail_from');
            $table->string('mail_host');
            $table->string('mail_user');
            $table->string('mail_password');
            $table->boolean('is_maintenence');
            $table->unsignedSmallInteger('session_timeout');
            $table->unsignedSmallInteger('timeout');
            $table->string('timezone');
            $table->smallInteger('token_lifetime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_servers');
    }
};
