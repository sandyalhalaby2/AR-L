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
        Schema::create('complete_the_letter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exercise_id')->constrained('exercises')->onDelete('cascade') ;
            $table->text('question') ;
            $table->text('sentence_with_blank');
            $table->string('letters');
            $table->string('sorted_letters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complete_the_letter');
    }
};
