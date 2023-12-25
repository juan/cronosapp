<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_role', function (Blueprint $table) {
            $table->primary(['menu_id', 'role_id']);
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('role_id');
            $table->string('menu_option')->nullable();
            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onDelete('cascade');

            $table->foreign('menu_id')
                ->references('id')->on('menus')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_role');
    }
};
