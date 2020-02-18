<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SaleAdditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('CRM_Sale', function (Blueprint $table) {
            $table->integer('user_branch_id')->unsigned()->index()->nullable();
            $table->foreign('user_branch_id')->references('id')->on('user_branches')->onDelete('no action');
            
            $table->integer('lead_type_id')->unsigned()->index()->nullable();
            $table->foreign('lead_type_id')->references('id')->on('lead_types')->onDelete('cascade');
            
            // $table->integer('sector_id')->unsigned()->index()->nullable();
            // $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            
            $table->integer('posted_by_user')->unsigned()->index()->nullable();
            $table->foreign('posted_by_user')->references('id')->on('Login_Users')->onDelete('cascade');
            
             $table->integer('action_by')->unsigned()->index()->nullable();
            $table->foreign('action_by')->references('id')->on('Login_Users')->onDelete('no action');
             
             $table->integer('source_id')->unsigned()->index()->nullable();
            $table->foreign('source_id')->references('id')->on('sectors')->onDelete('no action');
            
            $table->integer('destination_id')->unsigned()->index()->nullable();
            $table->foreign('destination_id')->references('id')->on('sectors')->onDelete('no action');
            
             $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('CRM_Sale', function (Blueprint $table) {
            $table->dropIndex('branch_id');	
            $table->dropIndex('lead_type_id');
            $table->dropIndex('posted_by_user');
            $table->dropIndex('action_by');	
                  $table->dropIndex('source_id');	
            $table->dropIndex('destination_id');
            $table->timestamps();	
        });
    }
}
