<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_season', function (Blueprint $table) {
            $table->id(); // id (bigint unsigned, PRIMARY KEY)
            $table->unsignedBigInteger('product_id'); // 外部キー (products.id)
            $table->unsignedBigInteger('season_id'); // 外部キー (seasons.id)
            $table->timestamps(); // created_at, updated_at (timestamp)

            // 外部キー制約
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_season');
    }
}
