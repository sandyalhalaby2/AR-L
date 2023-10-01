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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sub_skill_id')->constrained('sub_skills')
                ->onDelete('cascade');

            $table->text('content') ;

            $table->integer('xp') ;

            $table->string('audio_link')->nullable();

            $table->string('image_link')->nullable();

            $table->index('sub_skill_id') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
