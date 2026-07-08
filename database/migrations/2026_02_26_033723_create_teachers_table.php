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
        Schema::create('teachers', function (Blueprint $table) {
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
            $table->string('education_degree');
            $table->string('education_university');
            $table->integer('education_year');
            $table->integer('talent_score');
            $table->integer('gross_salary');
            $table->integer('food');
            $table->date('reg_date');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

         Schema::create('teacher_salary', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id');
            $table->integer('salary_year');
            $table->integer('salary_month');
            $table->integer('absent_amount')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('net_salary');
            $table->date('pay_date')->nullable();
            $table->primary(['teacher_id','salary_year','salary_month']);
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('no action');
        });

         Schema::create('teacher_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->string('document_name');
            $table->string('document_file');
            $table->date('upload_date');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
        });

         Schema::create('teacher_attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->date('absent_date');
            $table->text('remark')->nullable();
            $table->unique(['teacher_id','absent_date']);
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');    
    
        });
        
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('teacher_salary');
        Schema::dropIfExists('teacher_document');
        Schema::dropIfExists('teacher_attendance');
    }
};
