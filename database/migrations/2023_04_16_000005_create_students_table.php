<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('St_id');
            $table->bigInteger('St_phNumber');
            $table->string('St_fname');
            $table->string('St_lname');
            $table->string('St_gender');
            $table->string('St_DOB');
            $table->string('St_img')->nullable();
            $table->string('St_password');
            $table->unsignedBigInteger('D_id');
            $table->foreign('D_id')->references('D_id')->on('departments')->onDelete('cascade');
            $table->string('St_email');
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
        Schema::dropIfExists('students');
    }
}
