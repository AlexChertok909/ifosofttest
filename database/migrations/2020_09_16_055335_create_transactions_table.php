<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
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
			$table->string('type', 30);
			$table->bigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->bigInteger('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets');
			$table->bigInteger('deposit');
            $table->foreign('deposit')->references('id')->on('deposits');
			$table->float('balance', 8, 2)->default(0);
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
}
