<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnLeadTypeToSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CRM_Sale', function (Blueprint $table) {
            $table->integer('lead_type_id')->unsigned()->index()->nullable();
            $table->foreign('lead_type_id')->references('id')->on('lead_types')->onDelete('cascade');
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
            $table->dropIndex('lead_type_id');	
        });
    }
    
}
