<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();

            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->date('slot_date');
            $table->string('slot_time');

            $table->unsignedBigInteger('package_id')->nullable();

            // $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->unsignedBigInteger('price_id')->nullable();

            $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');

            $table->bigInteger('location_id')->nullable();


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
        Schema::dropIfExists('bookings');
    }
}
