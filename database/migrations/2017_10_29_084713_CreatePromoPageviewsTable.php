<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoPageviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventjuicer_promo_stats', function (Blueprint $table) {
            

            $table->increments("id");

            $table->unsignedInteger("organizer_id")->default(0)->index();
            $table->unsignedInteger("group_id")->default(0)->index();
            $table->unsignedInteger("event_id")->default(0)->index();

            $table->unsignedInteger("creative_id")->default(0)->index();
            $table->unsignedInteger("participant_id")->default(0)->index();

            $table->string("ip")->nullable();
            $table->text("geo")->nullable();
            $table->text("referer")->nullable();
            $table->text("ua")->nullable();
            $table->text("cookie")->nullable();

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
        // Schema::table('eventjuicer_promo_stats', function (Blueprint $table) {
        //     //
        // });
    }
}
