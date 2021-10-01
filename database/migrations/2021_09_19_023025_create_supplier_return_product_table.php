<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierReturnProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_return_product', function (Blueprint $table) {
            $table->foreignId('supplier_return_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->unique(['supplier_return_id', 'product_id']);
            $table->integer('quantity');
            $table->integer('cost_price');
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
        Schema::dropIfExists('supplier_return_product');
    }
}
