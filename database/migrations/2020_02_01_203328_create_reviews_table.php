<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('details')->nullable();
            $table->tinyInteger('rating');
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('cluster_id')->references('id')->on('cluster');
            $table->integer('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /*


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
