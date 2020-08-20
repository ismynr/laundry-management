<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaction');
            $table->unsignedBigInteger('id_package');
            $table->integer('qty');
            $table->integer('harga');
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('transaction_details', function($table) {
            $table->foreign('id_transaction')->references('id')->on('transactions');
            $table->foreign('id_package')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}
