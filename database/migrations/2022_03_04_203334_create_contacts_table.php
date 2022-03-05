<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable()->default(NULL);
            $table->string('email', 155)->nullable()->default(NULL);
            $table->string('mobile', 15)->nullable()->default(NULL);
            $table->string('phone', 15)->nullable()->default(NULL);
            $table->string('cnpj', 20)->nullable()->default(NULL);
            $table->string('company', 255)->nullable()->default(NULL);
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
        Schema::dropIfExists('contacts');
    }
}
