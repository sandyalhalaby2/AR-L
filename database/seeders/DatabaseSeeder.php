<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         DB::table('levels')->insert([
             'name' => 'المبتدئ الأدنى',
             'description' => 'test@example.com',
         ]);
        DB::table('levels')->insert([
            'name' => 'المبتدئ الأوسط',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المبتدئ الأعلى',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتوسط الأدنى',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتوسط الأوسط',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتوسط الأعلى',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتقدم الأدنى',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتقدم الأوسط',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتقدم الأعلى',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتميز الأدنى',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتميز الأوسط',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتميز الأعلى',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتفوق الأدنى',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتفوق الأوسط',
            'description' => 'test@example.com',
        ]);
        DB::table('levels')->insert([
            'name' => 'المتفوق الأعلى',
            'description' => 'test@example.com',
        ]);

        for ($i=1 ; $i<15 ; $i++ )
        {
            DB::table('skills')->insert([
                'level_id' => $i ,
                'type' => 'listening',
                'description' => 'test@example.com',
            ]);
            DB::table('skills')->insert([
                'level_id' => $i ,
                'type' => 'reading',
                'description' => 'test@example.com',
            ]);
            DB::table('skills')->insert([
                'level_id' => $i ,
                'type' => 'writing',
                'description' => 'test@example.com',
            ]);
        }

    }
}
