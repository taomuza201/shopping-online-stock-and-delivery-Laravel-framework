<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tags', function (Blueprint $table) {
            $table->bigIncrements('product_tags_id');

            $table->bigInteger('products_id')->unsigned()->index()->nullable();
            $table->foreign('products_id')->references('products_id')->on('products')->onDelete('cascade');

            $table->bigInteger('tags_id')->unsigned()->index()->nullable();
            $table->foreign('tags_id')->references('tags_id')->on('tags')->onDelete('cascade');
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
        Schema::dropIfExists('product_tags');
    }
}
