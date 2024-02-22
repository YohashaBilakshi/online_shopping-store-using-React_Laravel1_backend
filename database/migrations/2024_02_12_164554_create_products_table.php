<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('code');
            $table->string('name');
            $table->string('price');
            $table->integer('quantity')->default(0);
            $table->string('category');
            $table->float('discount')->default(0)->comment('%');
            $table->integer('active')->default(1);
            $table->float('dummy_price')->nullable();
            $table->longText('description')->nullable();
            $table->float('small_description')->nullable();
            $table->longText('inqueryImg')->nullable()->default(null)->change();
            $table->longText('keyword')->nullable();
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
};
