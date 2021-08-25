<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->default(1); // add walk-in customer as the 1st one
            $table->date('start_date'); // New Start Date
            $table->date('return_date');

            $table->float('order_value',20)->default('0.0');
            $table->float('discount_amount',20)->default('0.0');
            $table->float('amount_paid',20)->default('0.0');
            $table->integer('is_paid')->nullable(); // 0 = no, 1 = full, 2 = partial

            $table->string('comment')->nullable();

            $table->boolean('is_deleted')->default(0);
            $table->boolean('is_return')->default(0); // New is return
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
        Schema::dropIfExists('orders');
    }
}
