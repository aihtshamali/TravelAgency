<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyLeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('CRM_Leads', function (Blueprint $table) {
            $table->integer('taken_over_by')->unsigned()->index()->nullable();
            $table->foreign('taken_over_by')->references('id')->on('Login_Users')->onDelete('no action');
            $table->integer('closed_by')->unsigned()->index()->nullable();
            $table->foreign('closed_by')->references('id')->on('Login_Users')->onDelete('no action');
            $table->integer('last_updated_by')->unsigned()->index()->nullable();
            $table->foreign('last_updated_by')->references('id')->on('Login_Users')->onDelete('no action');
            $table->integer('source_id')->unsigned()->index()->nullable();
            $table->foreign('source_id')->references('id')->on('sectors')->onDelete('no action');
            $table->integer('destination_id')->unsigned()->index()->nullable();
            $table->foreign('destination_id')->references('id')->on('sectors')->onDelete('no action');
            $table->text('stays')->nullable();
            
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
            $table->dropIndex('closed_by');	
            $table->dropIndex('lead_type_id');	
            $table->dropIndex('last_updated_by');	
            $table->dropIndex('source_id');	
            $table->dropIndex('destination_id');
            $table->dropColumn('stays');	
        });
    }
}
