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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('state_id')->default(1)->constrained();
            $table->string('company_name');
            $table->string('company_cuit')->unique();
            $table->string('company_address');
            $table->string('company_phone');
            $table->string('company_zipcode')->nullable();
            $table->string('company_email')->unique();
            $table->string('company_web')->nullable();
            $table->string('company_person_contact');
            $table->string('company_person_phone');
            $table->string('company_person_email');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
