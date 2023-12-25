<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->nullable()->constrained();
            $table->integer('numcolum')->nullable();
            $table->string('namemenu')->nullable();
            $table->string('titulo')->nullable();
            $table->string('bigicon')->nullable();
            $table->string('inicial')->nullable();
            $table->string('linkto')->nullable();
            $table->text('descripcion')->nullable()->fulltext();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
