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
               
        Schema::create('agences', function (Blueprint $table) {
            $table->id();
            $table->string("name",120);
            $table->string("email");
            $table->string("phone",15);
            $table->string("Country");
            $table->string("Agency_type");
            $table->string("bio");
            $table->string("pic");
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
        Schema::dropIfExists('agences');
    }
};
