<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->float('amount',20)->default('0.0');
            $table->string('account_type')->default('Cash');
            $table->integer('customer_id');
            $table->string('customer_name')->nullable();
            $table->string('category'); // Advance Payment, Final Payment
            $table->string('reference')->default('Self');
            $table->string('description')->nullable();

            $table->boolean('is_deleted')->default(0);
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
        Schema::dropIfExists('accounts');
    }
}
