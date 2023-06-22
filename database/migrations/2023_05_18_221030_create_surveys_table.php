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
        Schema::create('surveys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('type');
            $table->tinyInteger('for');
            $table->date('start');
            $table->date('end');
//            $table->unsignedBigInteger('teacher_id')->nullable();
//            $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnUpdate()->cascadeOnDelete();
//            $table->unsignedBigInteger('subject_id')->nullable();
//            $table->foreign('subject_id')->references('id')->on('subjects')->cascadeOnUpdate()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
