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
            $table->bigIncrements('comments_id');
            $table->string('comments_sex');
            $table->string('comments_name');
            $table->string('comments_email');
            $table->mediumText('comments_detail');

            $table->bigInteger('products_id')->unsigned()->index()->nullable();
            $table->foreign('products_id')->references('products_id')->on('products')->onDelete('cascade');


            
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
        Schema::dropIfExists('comments');
    }
}
