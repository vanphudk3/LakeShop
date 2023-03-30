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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->unsigned();
            $table->string('re_email');
            $table->string('re_name');
            $table->char('re_phone', 11);
            $table->string('re_address');
            $table->integer('total_price');
            $table->enum('status', ['pending', 'success', 'cancel']);
            $table->integer('payment_method');
            $table->enum('payment_status',['pending', 'success', 'cancel']);
            $table->string('message')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
