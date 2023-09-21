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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
              ->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained('lessons') ;

            $table->foreignId('exercise_id')->constrained('exercises') ;

            $table->enum('completionStatus' , ['completed' , 'progress' , 'not-started']) ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
