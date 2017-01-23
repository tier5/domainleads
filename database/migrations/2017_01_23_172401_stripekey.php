<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Stripekey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Stripekey', function (Blueprint $table) {
            $table->increments('id');
            $table->string('publishable_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::drop('Stripekey');
    }
}
