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
            $table->id(); // id (bigint unsigned, PRIMARY KEY)
            $table->string('name', 255); // 商品名 (varchar(255), NOT NULL)
            $table->integer('price'); // 価格 (int, NOT NULL)
            $table->string('image', 255); // 商品画像 (varchar(255), NOT NULL)
            $table->text('description'); // 商品説明 (text, NOT NULL)
            $table->timestamps(); // created_at, updated_at (timestamp)

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
