<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActionByToSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CRM_Sale', function (Blueprint $table) {
            $table->integer('action_by')->unsigned()->index()->nullable();
            $table->foreign('action_by')->references('id')->on('Login_Users')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('CRM_Sale', function (Blueprint $table) {
            $table->dropIndex('action_by');	
        });
    }
}
