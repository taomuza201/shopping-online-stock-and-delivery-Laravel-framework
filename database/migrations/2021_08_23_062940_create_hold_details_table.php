<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hold_details', function (Blueprint $table) {
            $table->bigIncrements('hold_details_id');

            $table->integer('hold_details_products_amount')->default(0);
            $table->integer('hold_details_products_price')->default(0);
            
            $table->bigInteger('hold_details_products_id')->unsigned()->index()->nullable();
            $table->foreign('hold_details_products_id')->references('products_id')->on('products')->onDelete('cascade');

            
            $table->bigInteger('hold_details_hold_id')->unsigned()->index()->nullable();
            $table->foreign('hold_details_hold_id')->references('holds_id')->on('holds')->onDelete('cascade');

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
        Schema::dropIfExists('hold_details');
    }
}
