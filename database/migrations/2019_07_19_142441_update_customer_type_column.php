<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCustomerTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('CRM_Customers', function (Blueprint $table) {
            $table->string( 'CustomerType' )->nullable()->change();
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
        Schema::table('CRM_Customers', function (Blueprint $table) {
            $table->string('CustomerType')->nullable(false)->change();
           });
    }
}
