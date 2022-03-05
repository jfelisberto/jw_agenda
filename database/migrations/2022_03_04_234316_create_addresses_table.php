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
            $table->bigInteger('contact_id')->unsigned()->nullable()->default(NULL);
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->bigInteger('user_id')->unsigned()->nullable()->default(NULL);
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('type', 20)->nullable()->default(NULL);
            $table->string('zipcode', 20)->nullable()->default(NULL);
            $table->string('public_place', 155)->nullable()->default(NULL);
            $table->string('address', 255)->nullable()->default(NULL);
            $table->string('number', 15)->nullable()->default(NULL);
            $table->string('complement', 155)->nullable()->default(NULL);
            $table->string('district', 255)->nullable()->default(NULL);
            $table->string('city', 255)->nullable()->default(NULL);
            $table->string('state', 155)->nullable()->default(NULL);
            $table->string('country', 155)->nullable()->default(NULL);
            $table->timestamps();
            $table->softDeletes();
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
