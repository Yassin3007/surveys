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
        Schema::create('teacher_tables', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_name')->nullable();
            $table->string('comp_num')->nullable();
            $table->string('subject_name')->nullable();
            $table->string('subject_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_tables');
    }
};
