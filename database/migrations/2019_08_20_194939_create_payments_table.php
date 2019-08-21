<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::table('CRM_Payments', function (Blueprint $table) {
            $table->integer('user_branch_id')->unsigned()->index()->nullable();
            $table->foreign('user_branch_id')->references('id')->on('user_branches')->onDelete('no action');
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
            $table->dropIndex('user_branch_id');	
        });
    }
}
