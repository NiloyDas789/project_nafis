<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('patients_id');
            $table->dateTime('appointment_at');
            $table->string('treatment_type');
            $table->boolean('confirmed')->default(true);
            $table->integer('initial_sms_sent')->default(0);
            $table->integer('unavailability_sms_sent')->default(0); // 0 = new, 1 = cancelled, 2 = something else
            $table->integer('reminder_sms_sent')->default(0);       // 0 = new, 1 = sent, 2 = failed or something else
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
        Schema::dropIfExists('appointments');
    }
}
