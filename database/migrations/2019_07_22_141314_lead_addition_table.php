<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LeadAdditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CRM_Leads', function (Blueprint $table) {
            $table->integer('lead_type_id')->unsigned()->index()->nullable();
            $table->foreign('lead_type_id')->references('id')->on('lead_types')->onDelete('cascade');
            
             $table->integer('branch_id')->unsigned()->index()->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('Login_Users')->onDelete('cascade');
            
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
            
            $table->bigInteger('priority_id')->unsigned()->index()->nullable();
            $table->foreign('priority_id')->references('id')->on('priorities')->onDelete('no action');
            
            $table->text('stays')->nullable();
           
            
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
            $table->dropIndex('branch_id');	
            $table->dropIndex('user_id');
            $table->dropIndex('taken_over_by');	
            $table->dropIndex('closed_by');	
            $table->dropIndex('last_updated_by');	
            $table->dropIndex('source_id');	
            $table->dropIndex('destination_id');
            $table->dropIndex('priority_id');
            $table->dropColumn('stays');
            $table->dropColumn('status');	
        });
    }
}
