<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('sale_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('SaleID')->unsigned()->index()->nullable();
            $table->foreign('SaleID')->references('SaleID')->on('CRM_Sale')->onDelete('no action');
            $table->string('ticket_attachment')->nullable();
            $table->string('document_name')->nullable();
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
        Schema::dropIfExists('sale_attachments');
    }
}
