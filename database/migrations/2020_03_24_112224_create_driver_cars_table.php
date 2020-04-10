<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_of_car',100);
            $table->decimal('max_weight',8,2);
            $table->decimal('internal_length',8,2);
            $table->decimal('internal_height',8,2);
            $table->decimal('internal_width',8,2);
            $table->decimal('max_capacity',8,2);
            $table->bigInteger('driver_id');
            $table->string('thumbnail',192);
            $table->bigInteger('type_of_car');



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
        Schema::dropIfExists('driver_cars');
    }
}
