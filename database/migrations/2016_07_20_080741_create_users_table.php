<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('remember_token')->nullable();

            $table->string('registrant_name');
            $table->string('registrant_company');
            $table->string('registrant_address');
            $table->string('registrant_city');
            $table->string('registrant_state');
            $table->string('registrant_zip');
            $table->string('registrant_country');
           
            $table->string('registrant_phone');
            $table->string('registrant_fax');
            $table->string('administrative_name');
            $table->string('administrative_company');
            $table->string('administrative_address');
            $table->string('administrative_city');
            $table->string('administrative_state');
            $table->string('administrative_zip');

            $table->string('administrative_country');
            $table->string('administrative_email');
            $table->string('administrative_phone');
            $table->string('administrative_fax');
            $table->string('technical_name');
            $table->string('technical_company');
            $table->string('technical_address');
            $table->string('technical_city');
            $table->string('technical_state');
            $table->string('technical_zip');
            $table->string('technical_country');
            $table->string('technical_email');
            $table->string('technical_phone');
            $table->string('technical_fax');
            

            $table->string('billing_name');
            $table->string('billing_company');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_zip');
            $table->string('billing_country');
            $table->string('billing_email');
            $table->string('billing_phone');
            $table->string('billing_fax');
            $table->string('name_server_1');
            $table->string('name_server_2');
            $table->string('name_server_3');
            $table->string('name_server_4');
            $table->string('domain_status_1');
            $table->string('domain_status_2');
            $table->string('domain_status_3');
            $table->string('domain_status_4');



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
        Schema::drop('users');
    }
}
