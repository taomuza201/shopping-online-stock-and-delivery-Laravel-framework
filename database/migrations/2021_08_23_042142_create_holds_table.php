<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holds', function (Blueprint $table) {
            $table->bigIncrements('holds_id');

            $table->string('holds_code');
            $table->string('holds_name');

            $table->string('holds_tel')->nullable();
            $table->mediumText('holds_detail')->nullable();

            $table->bigInteger('holds_users_id')->unsigned()->index()->nullable();
            $table->foreign('holds_users_id')->references('id')->on('users')->onDelete('cascade');


            $table->mediumText('holds_address')->nullable();    
            
            
            $table->string('holds_house_number')->nullable();   
            $table->string('holds_village')->nullable();   
            $table->string('holds_alley')->nullable();   //ซอย
            $table->string('holds_road')->nullable();   
            $table->string('holds_provinces')->nullable();   
            $table->string('holds_amphures')->nullable();   
            $table->string('holds_districts')->nullable();   
            $table->string('holds_zip_code')->nullable();   

            $table->string('holds_transport_number')->nullable();   



            $table->string('holds_slip_pay')->nullable();   
            $table->string('holds_slip_to_owner')->nullable();   


            $table->string('holds_status');
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
        Schema::dropIfExists('holds');
    }
}
