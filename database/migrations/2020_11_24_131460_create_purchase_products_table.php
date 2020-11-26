<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('purchase_id')->references('id')->on('purchases');
            $table->foreignId('product_id')->references('id')->on('products');

            $table->integer('quantity')->default(0);
            $table->float('price_purchase', 24, 2)->default(0);            
            $table->float('total', 24, 2)->default(0);

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
        Schema::dropIfExists('purchase_products');
    }
}
