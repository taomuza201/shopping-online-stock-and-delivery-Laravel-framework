<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_logs', function (Blueprint $table) {
            $table->bigIncrements('products_logs_id');
            $table->integer('products_logs_amount');
            $table->string('products_logs_status'); //add / reduce

            $table->bigInteger('products_id')->unsigned()->index()->nullable();
            $table->foreign('products_id')->references('products_id')->on('products')->onDelete('cascade');

            $table->bigInteger('products_logs_make_by')->unsigned()->index()->nullable();
            $table->foreign('products_logs_make_by')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('products_logs');
    }
}
