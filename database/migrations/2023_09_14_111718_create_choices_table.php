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
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exercise_id')->constrained('exercises')
                ->onDelete('cascade');

            $table->foreignId('lesson_id')->constrained('lessons') ;

            $table->foreignId('course_id')->constrained('courses') ;

            $table->text('text');

            $table->boolean('is_correct')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
