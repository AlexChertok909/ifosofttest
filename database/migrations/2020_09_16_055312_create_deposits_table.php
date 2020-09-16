<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
			$table->bigInteger('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets');
			$table->float('invested', 8, 2)->default(0);
			$table->float('percent', 8, 2)->default(0);
			$table->smallInteger('active')->default(0);
			$table->smallInteger('duration')->default(0);
			$table->smallInteger('accrue_times')->default(0);
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
        Schema::dropIfExists('deposits');
    }
}
