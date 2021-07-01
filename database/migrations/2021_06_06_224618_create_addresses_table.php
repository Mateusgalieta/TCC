<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('cep')->nullable();
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->unsignedBigInteger('contact_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('contact_id')->references('id')->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
