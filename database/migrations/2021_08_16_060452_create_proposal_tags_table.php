<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_tags', function (Blueprint $table) {
            $table->bigIncrements('proposal_tags_id');

            $table->bigInteger('proposals_id')->unsigned()->index()->nullable();
            $table->foreign('proposals_id')->references('proposals_id')->on('proposals')->onDelete('cascade');

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
        Schema::dropIfExists('proposal_tags');
    }
}
