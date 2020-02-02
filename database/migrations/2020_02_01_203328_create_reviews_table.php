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
 *  CREATE TABLE `markers` (
      `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
      `name` VARCHAR( 60 ) NOT NULL ,
      `address` VARCHAR( 80 ) NOT NULL ,
      `lat` FLOAT( 10, 6 ) NOT NULL ,
      `lng` FLOAT( 10, 6 ) NOT NULL ,
      `type` VARCHAR( 30 ) NOT NULL
    ) ENGINE = MYISAM ;
 */

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
