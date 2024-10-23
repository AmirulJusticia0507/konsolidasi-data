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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 50)->unique();
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('email', 100)->unique();
            $table->string('gender', 20)->nullable();
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('phone_number', 20)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('job_title', 50)->nullable();
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
        Schema::dropIfExists('employees');
    }
};
