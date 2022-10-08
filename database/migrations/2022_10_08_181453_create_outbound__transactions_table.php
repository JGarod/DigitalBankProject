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
        Schema::create('outbound__transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receive_wallet_id')->constrained('wallets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('send_wallet_id')->constrained('wallets')->onDelete('cascade')->onUpdate('cascade');
            $table->double('outbound_amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outbound__transactions');
    }
};
