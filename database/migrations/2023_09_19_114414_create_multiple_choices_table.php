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
        Schema::create('multiple_choices', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('exercise_id')->nullable();
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');

            $table->text('question');

            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
            $table->string('option_4')->nullable();
            $table->string('option_5')->nullable();

            $table->enum('isCorrect' , ['option_1' , 'option_2' , 'option_3' , 'option_4' , 'option_5']) ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiple_choices');
    }
};
