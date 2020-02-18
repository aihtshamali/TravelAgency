<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CashbookCashindexAddition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CashBook_Data', function (Blueprint $table) {
            $table->integer('posted_by_id')->unsigned()->index()->nullable();
            $table->foreign('posted_by_id')->references('id')->on('Login_Users')->onDelete('no action');
            
            $table->bigInteger('bank_id')->unsigned()->index()->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('no action');
            
            $table->integer('payment_form_id')->unsigned()->index()->nullable();
            $table->foreign('payment_form_id')->references('id')->on('payment_forms')->onDelete('no action');
            
             $table->string('chequeOrcard')->nullable();
        });
        
        Schema::table('CashBook_Index', function (Blueprint $table) {
            $table->integer('closed_by_id')->unsigned()->index()->nullable();
            $table->foreign('closed_by_id')->references('id')->on('Login_Users')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('CashBook_Data', function (Blueprint $table) {
            $table->dropIndex('posted_by_id');
            $table->dropIndex('bank_id');
            $table->dropIndex('payment_form_id');
            $table->dropColumn('chequeOrcard');
        
    });
    
     Schema::table('CashBook_Index', function (Blueprint $table) {
              $table->dropIndex('closed_by_id');
        });
    }
}
