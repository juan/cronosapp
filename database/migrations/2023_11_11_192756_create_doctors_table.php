<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->nullable()->constrained();
            $table->foreignId('specialtie_id')->nullable()->constrained();
            $table->foreignId('type_id')->nullable()->constrained();
            $table->foreignId('state_id')->default(1)->constrained();
            $table->string('num_matricula');
            $table->boolean('interno_doc')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
