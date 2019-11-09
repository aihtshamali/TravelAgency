<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSourceAndDestinationToSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('CRM_Sale', function (Blueprint $table) {
            
            $table->integer('source_id')->unsigned()->index()->nullable();
            $table->foreign('source_id')->references('id')->on('sectors')->onDelete('no action');
            $table->integer('destination_id')->unsigned()->index()->nullable();
            $table->foreign('destination_id')->references('id')->on('sectors')->onDelete('no action');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('CRM_Leads', function (Blueprint $table) {
            
            $table->dropIndex('source_id');	
            $table->dropIndex('destination_id');
            
        });
    }
}
