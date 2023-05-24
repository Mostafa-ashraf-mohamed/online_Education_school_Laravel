<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('C_id');
            $table->string('C_comment');
            $table->unsignedBigInteger('V_id');
            $table->foreign('V_id')->references('V_id')->on('videos')->onDelete('cascade'); 
            $table->unsignedBigInteger('St_id');
            $table->foreign('St_id')->references('St_id')->on('students')->onDelete('cascade'); 
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
