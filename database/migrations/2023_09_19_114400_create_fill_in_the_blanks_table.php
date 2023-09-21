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
        Schema::create('fill_in_the_blanks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('exercise_id')->nullable();

            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');

            $table->text('question') ;
            $table->text('sentence_with_blank');
            $table->string('correct_answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill_in_the_blanks');
    }
};
