<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('T_id');
            $table->bigInteger('T_phNumber');
            $table->string('T_gender');
            $table->unsignedBigInteger('S_id');
            $table->foreign('S_id')->references('S_id')->on('subjects')->onDelete('cascade');
            $table->string('T_fname');
            $table->string('T_lname');
            $table->string('T_email')->nullable();
            $table->string('T_img');
            $table->string('T_password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
