<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerAdditionTable extends Migration
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
            
            $table->string( 'CustomerType' )->nullable()->change();
            
            $table->integer('branch_id')->unsigned()->index()->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('NO ACTION');
            
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('Login_Users')->onDelete('no action');
            
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
       Schema::table('CRM_Customers', function (Blueprint $table) {
             $table->string('CustomerType')->nullable(false)->change();
             $table->dropIndex('branch_id');
             $table->dropIndex('user_id');
             $table->dropColumn('status');
           });
    }
}
