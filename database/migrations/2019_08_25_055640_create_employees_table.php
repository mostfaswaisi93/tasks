<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullName');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('jobTitle');
            $table->integer('department_id');
            $table->integer('user_id');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'inactive', 'leave'])->default('pending');
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
}
