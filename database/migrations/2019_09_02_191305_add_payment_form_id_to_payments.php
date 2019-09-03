<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentFormIdToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CRM_Payments', function (Blueprint $table) {
            $table->integer('payment_form_id')->unsigned()->index()->nullable();
            $table->foreign('payment_form_id')->references('id')->on('payment_forms')->onDelete('cascade');
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
            $table->dropIndex('payment_form_id');	
        });
    }
}
