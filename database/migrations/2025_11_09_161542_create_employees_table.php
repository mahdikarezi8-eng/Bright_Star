<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->integer('gender');
            $table->integer('birth_year');
            $table->string('image');
            $table->string('nic');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('curent_address');
            $table->string('province');
            $table->string('position');
            $table->integer('gross_salary');
            $table->date('reg_date');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
            Schema::create('employee_salary', function (Blueprint $table) {
                $table->unsignedBigInteger('employee_id');
                $table->integer('salary_year');
                $table->integer('salary_month');
                $table->date('pay_date')->nullable();
                $table->integer('absent_amount')->default(0);
                $table->integer('net_salary')->default(0);
                $table->primary(['employee_id','salary_year','salary_month']);
                $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('no action');
            });


        Schema::create('employee_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('document_name');
            $table->string('document_file');
            $table->date('upload_date');
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
        });

         Schema::create('employee_attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('attendance_date');
            $table->text('remark')->nullable();
            $table->unique(['employee_id','attendance_date']);
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
        });

        
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('employee_salary');
        Schema::dropIfExists('employee_document');
        Schema::dropIfExists('employee_attendance');
    }

};
