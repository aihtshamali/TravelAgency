<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Package extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('attachment')->nullable();
            
             $table->date('start_date')->nullable();
             $table->date('end_date')->nullable();
            
            $table->integer('source_id')->unsigned()->index()->nullable();
            $table->foreign('source_id')->references('id')->on('sectors')->onDelete('no action');
            
            $table->integer('destination_id')->unsigned()->index()->nullable();
            $table->foreign('destination_id')->references('id')->on('sectors')->onDelete('no action');
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
        //
    }
}
