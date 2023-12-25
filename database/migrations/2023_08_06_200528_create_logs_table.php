<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('modelclass');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('query_id')->constrained();
            $table->ipAddress('ip')->nullable();
            $table->string('form_name', 200)->nullable();
            $table->text('message')->nullable();
            $table->string('query_type', 200)->nullable();
            $table->text('querymessage')->nullable();
            $table->json('querystring')->nullable();
            $table->string('device_type', 200)->nullable();
            $table->string('browser_type', 200)->nullable();
            $table->string('browser_version', 100)->nullable();
            $table->string('opsys_type', 200)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
