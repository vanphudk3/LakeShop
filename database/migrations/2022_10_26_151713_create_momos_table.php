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
        Schema::create('momos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->nullable()->unsigned();
            $table->string('partnerCode');
            $table->integer('amount');
            $table->string('order_info');
            $table->string('order_type');
            $table->integer('cart_code');
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
        Schema::dropIfExists('momos');
    }
};
