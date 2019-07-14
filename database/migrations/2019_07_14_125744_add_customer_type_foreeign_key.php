<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerTypeForeeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CRM_Customers', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->integer('customer_type_id')->unsigned()->index()->nullable();
            $table->foreign('customer_type_id')->references('id')->on('customer_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
