<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->bigIncrements('proposals_id');
            $table->string('proposals_name');
            $table->mediumText('proposals_about');
            $table->decimal('proposals_price_cost',9,2);
            $table->decimal('proposals_price',9,2);
            $table->integer('proposals_amount')->default(0);
            $table->string('proposals_cover_photo');
            $table->longText('proposals_story')->nullable();
            $table->tinyInteger('proposals_status')->default(1);

            $table->bigInteger('proposals_owner_id')->unsigned()->index()->nullable();
            $table->foreign('proposals_owner_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('proposals');
    }
}
