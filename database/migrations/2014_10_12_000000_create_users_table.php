<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('shops', function (Blueprint $table) {
            $table->id();            

            $table->string("name");
            $table->string("bio");
            $table->string("image")->default('default.png');

            $table->timestamps();
        });
        
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shop_id')->references('id')->on('shops');

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

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
        Schema::dropIfExists('shops');
    }
}
