<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',60);
            $table->text('description');


            $table->Biginteger('city_id')->unsigned()->nullable();
            $table->Biginteger('region_id')->unsigned();
            $table->Biginteger('country_id')->unsigned();
            $table->decimal('price_per_km',5,2)->default(0.00);
            $table->decimal('internal_width',5,2)->default(0.00)->nullable();
            $table->decimal('internal_height',5,2)->default(0.00)->nullable();
            $table->decimal('internal_length',5,2)->default(0.00)->nullable();
            $table->decimal('capacity',5,2)->default(0.00);
            $table->decimal('max_weight',5,2)->default(0.00);
            $table->Biginteger('cars_type_id')->unsigned();
            $table->Biginteger('driver_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();






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
        Schema::dropIfExists('driver_offers');
    }
}
