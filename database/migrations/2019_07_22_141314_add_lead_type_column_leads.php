<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeadTypeColumnLeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CRM_Leads', function (Blueprint $table) {
            $table->integer('lead_type_id')->unsigned()->index()->nullable()->after('LeadType');
            $table->foreign('lead_type_id')->references('id')->on('lead_types')->onDelete('cascade');
            $table->boolean('status')->default(1);
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
            $table->dropIndex('lead_type_id');	
            $table->dropColumn('status');	
        });
    }
}
