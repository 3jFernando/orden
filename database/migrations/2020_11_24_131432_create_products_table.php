<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->references('id')->on('categories');

            $table->string('name');
            $table->string('image')->default('default.png');
            $table->string('reference')->default('prod-'.rand(34334, 55656));
            $table->integer('quantity')->default(0);
            $table->float('price_purchase', 12, 2)->default(0);
            $table->float('price_sale', 12, 2)->default(0);
            $table->float('utility', 12, 2)->default(0);
                    
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
        Schema::dropIfExists('products');
    }
}
