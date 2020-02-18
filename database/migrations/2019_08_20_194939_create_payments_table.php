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
            
               $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('Login_Users')->onDelete('cascade');
            
              $table->integer('payment_form_id')->unsigned()->index()->nullable();
            $table->foreign('payment_form_id')->references('id')->on('payment_forms')->onDelete('cascade');
            
              $table->bigInteger('bank_id')->unsigned()->index()->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('no action');
            
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
            $table->dropIndex('user_branch_id');
            $table->dropIndex('user_id');	
             $table->dropIndex('payment_form_id');
               $table->dropIndex('bank_id');
               $table->dropIndex('auth_by');	
        });
    }
}
