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
        Schema::create('outcome_sources', function (Blueprint $table) {
            $table->id();
            $table->string('source_name');
            $table->timestamps();
        });

        Schema::create('outcomes', function (Blueprint $table) {
            $table->id();
            $table->integer('outcome_amount');
            $table->date('outcome_date');
            $table->unsignedBigInteger('source_id');
            $table->foreign('source_id')->references('id')->on('outcome_sources')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outcome_sources');
        Schema::dropIfExists('outcomes');
    }
};
