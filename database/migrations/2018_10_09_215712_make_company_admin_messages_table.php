<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeCompanyAdminMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventjuicer_company_admin_msgs', function (Blueprint $table) {
                
            $table->increments("id");

            $table->unsignedInteger("company_id")->index();
            $table->unsignedInteger("read_by")->default(0)->index();
            $table->unsignedInteger("admin_id")->index();
            $table->unsignedInteger("msg_id")->default(0)->index();

            $table->timestamp("read_at")->nullable();
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
        Schema::drop('eventjuicer_company_admin_msgs');
        
    }
}
