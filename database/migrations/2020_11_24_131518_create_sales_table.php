<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('shop_id')->references('id')->on('shops');
            $table->foreignId('contact_id')->references('id')->on('contacts');

            $table->float('subtotal', 24, 2)->default(0);
            $table->float('discount', 24, 2)->default(0);
            $table->float('total', 24, 2)->default(0);
            $table->float('total_utility', 24, 2)->default(0);
            
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
        Schema::dropIfExists('sales');
    }
}
