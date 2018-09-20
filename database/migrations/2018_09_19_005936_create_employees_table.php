<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fullName');
            $table->integer('brCpf');
            $table->string('email')->unique();
            $table->string('telephoneType');
            $table->string('telephone');
            $table->string('zipCode');
            $table->string('city');
            $table->string('state');
            $table->string('avenue');
            $table->integer('number');
            $table->string('neighborhood');
            $table->string('password');
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
        Schema::dropIfExists('employee');
    }
}
