<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttachmentCustomerAndSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('CRM_Sale', function (Blueprint $table) {
             $table->string('ticket_attachment')->nullable();
             $table->string('document_name')->nullable();
         });
         Schema::table('CRM_Customers', function (Blueprint $table) {
             $table->string('document_attachment')->nullable();
             $table->string('document_name')->nullable();
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
