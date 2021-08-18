<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Product',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_category');
            $table->string('product_brand');
            $table->string('product_status');
            $table->string('product_sale_price');
            $table->string('product_image');
            $table->string('product_detail');
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
