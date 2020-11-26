<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sale_id')->references('id')->on('sales');
            $table->foreignId('product_id')->references('id')->on('products');

            $table->integer('quantity')->default(0);
            $table->float('price_sale_unit', 24, 2)->default(0);
            $table->float('total', 24, 2)->default(0);
            $table->float('utility', 24, 2)->default(0);

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
        Schema::dropIfExists('sale_products');
    }
}
