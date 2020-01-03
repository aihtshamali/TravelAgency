<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('CustomerID')->unsigned()->index()->nullable();
            $table->foreign('CustomerID')->references('CustomerID')->on('CRM_Customers')->onDelete('no action');
            $table->string('customerDocs')->nullable();
            $table->string('customerDocName')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
        
        
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_attachments');
    }
}
