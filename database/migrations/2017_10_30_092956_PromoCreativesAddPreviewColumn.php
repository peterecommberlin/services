<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PromoCreativesAddPreviewColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventjuicer_promo_templates', function (Blueprint $table) {
            

            $table->string("template_path")->nullable();
            $table->string("template_preview_path")->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eventjuicer_promo_templates', function (Blueprint $table) {
            //
        });
    }
}
