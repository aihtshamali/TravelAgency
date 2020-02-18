<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::rename('Login_Users', 'Login_Users_Old');
        
        Schema::create('Login_Users', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('login_count')->nullable();
            $table->string('user_name');
            $table->string('name');
            $table->string('password');
            $table->string('email')->nullable();
            $table->integer('phone')->nullable();
            $table->boolean('login_status')->default(0);
            $table->boolean('status')->default(1);
            $table->string('browser_id')->nullable();
            $table->string('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
