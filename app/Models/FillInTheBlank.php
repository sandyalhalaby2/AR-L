<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FillInTheBlank extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id' , 'question','sentence_with_blank', 'correct_answer'
    ];

}
