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
         Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
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
            $table->foreign('class_id')->references('id')->on('classes')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        
         Schema::create('student_fees', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->integer('fees_year');
            $table->integer('fees_month');
            $table->integer('fees_amount')->default(0);
            $table->date('fees_date');
            $table->primary(['student_id','fees_year','fees_month']);
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
         });

          Schema::create('student_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('document_name');
            $table->string('document_file');
            $table->date('upload_date');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
        });
         Schema::create('student_attendance', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->date('absent_date');
            $table->text('absent_type');
            $table->primary(['student_id','absent_date']);
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('student_fees');
        Schema::dropIfExists('student_document');
        Schema::dropIfExists('student_attendance');
        Schema::dropIfExists('studens');
    }

};
