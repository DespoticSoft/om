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
        Schema::create('stores', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('address');
            $table->double('min')->nullable();
            $table->double('max')->nullable();
            $table->timestamps();
        });
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('store_id')->index()->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->timestamps();
        });
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('parent')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->bigInteger('updated_by')->unsigned()->index()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();

            $table->string('image')->nullable();
            $table->string('qr')->nullable();
            $table->text('description')->nullable();


            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('product_categories');


            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->string('serial')->nullable();
            $table->string('grade')->nullable();

            $table->double('net_weight')->nullable();
            $table->double('gross_weight')->nullable();

            $table->string('code')->nullable();
            $table->string('style_name')->nullable();
            $table->string('style_no')->nullable();

            $table->bigInteger('measurements_id')->unsigned()->index()->nullable();
            $table->foreign('measurements_id')->references('id')->on('measurements');

            $table->bigInteger('brand_id')->unsigned()->index()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->bigInteger('store_id')->unsigned()->index()->nullable();
            $table->foreign('store_id')->references('id')->on('stores');

            $table->bigInteger('supplier_id')->unsigned()->index()->nullable();
            $table->foreign('supplier_id')->references('id')->on('users');

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
        Schema::dropIfExists('stores');
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('products');
    }
}

