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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('id_num')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('number')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->default(1);
            $table->tinyInteger('mode')->default(0);
//            $table->tinyInteger('grade_id')->nullable();
            $table->tinyInteger('stage')->nullable();
//            $table->foreign('grade_id')->references('id')->on('grades')->cascadeOnDelete()->cascadeOnUpdate();
//            $table->unsignedBigInteger('section_id')->nullable();
//            $table->foreign('section_id')->references('id')->on('sections')->cascadeOnDelete()->cascadeOnUpdate();
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
