<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config('database.connections.sqlsrv.driver') == 'sqlite') {
            return;
        }

        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('br_cpf');
            $table->string('email')->unique();
            $table->string('telephone_type');
            $table->string('telephone');
            $table->string('zip_code');
            $table->string('city');
            $table->string('state');
            $table->string('avenue');
            $table->bigInteger('number');
            $table->string('neighborhood');
            $table->string('complement');
            $table->string('password');
            $table->boolean('active');
            $table->rememberToken();
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
        if (config('database.connections.sqlsrv.driver') == 'sqlite') {
            return;
        }

        Schema::dropIfExists('employees');
    }
}
