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
        Schema::create('match_the_pairs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('exercise_id')->nullable();

            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');

            $table->text('question') ;

            $table->string('pair_1_item_a');
            $table->string('pair_1_item_b');

            $table->string('pair_2_item_a');
            $table->string('pair_2_item_b');

            $table->string('pair_3_item_a')->nullable();
            $table->string('pair_3_item_b')->nullable();

            $table->string('pair_4_item_a')->nullable();
            $table->string('pair_4_item_b')->nullable();

            $table->string('pair_5_item_a')->nullable();
            $table->string('pair_5_item_b')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_the_pairs');
    }
};
