<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableForSocialPromo2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('eventjuicer_promo_creatives', function (Blueprint $table)
        {
            

            $table->increments("id");



            $table->unsignedInteger("organizer_id")->default(0)->index();
            $table->unsignedInteger("group_id")->default(0)->index();
            $table->unsignedInteger("event_id")->default(0)->index();


            $table->unsignedInteger("participant_id")->default(0)->index();
            $table->unsignedInteger("template_id")->default(0)->index();

            $table->string("name")->nullable();

            $table->enum("act_as", ["link", "newsletter", "social", "banner"])->index();
            
            $table->longText("data")->nullable();

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
     //   Schema::dropIfExists('eventjuicer_promo_creatives');
    }
}
