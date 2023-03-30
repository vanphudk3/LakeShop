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
        Schema::create('vnpays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->nullable()->unsigned();
            $table->string('vnp_TxnRef');
            $table->string('vnp_Amount');
            $table->string('vnp_BankCode');
            $table->string('vnp_BankTranNo');
            $table->string('vnp_CardType');
            $table->string('vnp_ResponseCode');
            $table->string('vnp_TmnCode');
            $table->string('vnp_SecureHash');
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
        Schema::dropIfExists('vnpays');
    }
};
