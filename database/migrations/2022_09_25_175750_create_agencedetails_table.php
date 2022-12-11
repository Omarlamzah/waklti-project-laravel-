<?php

use App\Models\Agence;
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
        Schema::create('agencedetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_agences")->constrained("agences","id");
            $table->string("website")->nullable();
            $table->string("instagram")->nullable();
            $table->string("facebook")->nullable();
            $table->string("otherlinks")->nullable();
            $table->string("whatsap")->nullable();
            $table->string("adress")->nullable();
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
        Schema::dropIfExists('agencedetails');
    }
};
