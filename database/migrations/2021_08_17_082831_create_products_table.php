<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('products_id');
            $table->string('products_name');
            $table->string('products_name_short')->nullable();
            $table->mediumText('products_about_short')->nullable();
            $table->string('products_about_size')->nullable();
            $table->decimal('products_price_cost',9,2);
            $table->decimal('products_price',9,2);
            $table->integer('products_amount')->default(0);
            $table->string('products_cover_photo');
            $table->string('products_photo_1')->nullable();
            $table->string('products_photo_2')->nullable();
            $table->string('products_photo_3')->nullable();
            $table->string('products_photo_4')->nullable();
            $table->string('products_photo_5')->nullable();
            $table->longText('products_story')->nullable();
            $table->tinyInteger('products_status')->default(1);


            $table->bigInteger('products_owner_id')->unsigned()->index()->nullable();
            $table->foreign('products_owner_id')->references('id')->on('users')->onDelete('cascade');


            $table->bigInteger('products_proposals_id')->unsigned()->index()->nullable();
            $table->foreign('products_proposals_id')->references('proposals_id')->on('proposals')->onDelete('cascade');

            $table->string('products_type')->default('normal'); // normal  picture

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
        Schema::dropIfExists('products');
    }
}
