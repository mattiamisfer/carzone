<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranscationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcations', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->string('name');
            $table->string('status');

   $table->dateTime('start');
   $table->dateTime('end');
            $table->string('order_id');
            $table->string('payment_mode');
            $table->string('card_name');
            $table->string('amount');
            $table->string('traking_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->unsignedBigInteger('subcription_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
          //  $table->foreign('subcription_id')->references('id')->on('subcriptions')->onDelete('cascade');


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
        Schema::dropIfExists('transcations');
    }
}
