<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostedByUserToSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CRM_Sale', function (Blueprint $table) {
            $table->integer('posted_by_user')->unsigned()->index()->nullable();
            $table->foreign('posted_by_user')->references('id')->on('Login_Users')->onDelete('cascade');
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
            $table->dropIndex('posted_by_user');	
        });
    }
}
