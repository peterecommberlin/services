<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventjuicer_promo_templates', function (Blueprint $table) {
            
            $table->increments("id");

            $table->unsignedInteger("organizer_id")->default(0)->index();
            $table->unsignedInteger("group_id")->default(0)->index();
            $table->unsignedInteger("event_id")->default(0)->index();

            $table->string("path")->nullable();
            $table->longText("template")->nullable();

            $table->enum("act_as", ["newsletter","social", "banner"])->index();
            
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
        // Schema::table('eventjuicer_promo_templates', function (Blueprint $table) {
        //     //
        // });
    }
}
