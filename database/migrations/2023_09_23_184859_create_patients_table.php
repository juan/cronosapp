<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('identity_id')->constrained();
            $table->foreignId('gender_id')->default(1)
                ->constrained();
            $table->string('name_patient');
            $table->string('lastname_patient');
            $table->string('numberid_patient')->unique();
            $table->string('cuil_patient')->nullable();
            $table->date('datebirth');
            $table->string('cellphone');
            $table->string('email_patient')->nullable();
            $table->string('direccion_patient')->nullable();
            $table->timestamps();
            $table->index([
                'numberid_patient', 'name_patient', 'lastname_patient',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
