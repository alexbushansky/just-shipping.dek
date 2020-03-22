<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',60);
            $table->text('description')->nullable();

            $table->Biginteger('address_from_id')->unsigned();
            $table->Biginteger('address_to_id')->unsigned();



            $table->decimal('weight',5,2)->default(0.00);
            $table->decimal('price_per_km', 5, 2)->default(0.00);

            $table->string('thumbnail')->nullable();


            $table->date('date_start');
            $table->date('date_finish');


            $table->integer('cargo_type_id')->unsigned();

            $table->Biginteger('status_id')->unsigned();
            $table->Biginteger('customer_id')->unsigned();




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
        Schema::dropIfExists('customer_offers');
    }
}
