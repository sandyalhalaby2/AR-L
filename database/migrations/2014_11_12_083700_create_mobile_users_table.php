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
        Schema::create('mobile_users', function (Blueprint $table) {
            $table->id();

            $table->string('google_id')->nullable() ;

            $table->string('user_name');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password')->nullable() ;

            $table->string('profile_picture')->nullable() ;

            $table->string('phone_number')->nullable() ;

            $table->enum('permission' , ['normal' , 'verified' , 'premium','blocked'])->default('normal') ;

            $table->integer('xp')->default(0) ;

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_users');
    }
};
