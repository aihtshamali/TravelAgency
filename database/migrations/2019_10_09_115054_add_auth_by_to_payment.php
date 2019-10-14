<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthByToPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CRM_Payments', function (Blueprint $table) {
            $table->integer('auth_by')->unsigned()->index()->nullable();
            $table->foreign('auth_by')->references('id')->on('Login_Users')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('CRM_Payments', function (Blueprint $table) {
            $table->dropIndex('auth_by');	
        });
    }
}
