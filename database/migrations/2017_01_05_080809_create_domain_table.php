<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain', function (Blueprint $table) {

           $table->increments('id');
           $table->integer('user_id');
           $table->string('domain_name');
           $table->string('query_time');
            $table->string('create_date');
            $table->string('update_date');
            $table->string('expiry_date');
            $table->integer('domain_registrar_id');
            $table->string('domain_registrar_name');
            $table->string('domain_registrar_whois');
            $table->string('domain_registrar_url');

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
         Schema::drop("domain");
    }
}
