<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerReturnProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_return_product', function (Blueprint $table) {
            $table->foreignId('customer_return_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->unique(['customer_return_id', 'product_id']);
            $table->integer('quantity');
            $table->integer('list_price');
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
        Schema::dropIfExists('customer_return_product');
    }
}
