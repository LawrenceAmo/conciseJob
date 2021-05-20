<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emrecords', function (Blueprint $table) {
            $table->bigIncrements('userID')->index();
            $table->string('employee_number')->unique(); 
            $table->string('first_name')->nullable(); 
            $table->string('last_name')->nullable();
            $table->string('position')->nullable();
            $table->string('dob')->nullable();
            $table->string('start_date')->nullable();
            $table->string('department')->nullable(); 
            $table->decimal('annual_salary', $precision =12)->nullable();
            $table->string('manager_employee_number')->nullable();   
            $table->string('project_c1')->nullable();   
            $table->string('ptoject_c2')->nullable();   
            $table->string('project_c3')->nullable();   
            $table->string('email')->nullable();
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
        Schema::dropIfExists('emrecords');
    }
}
