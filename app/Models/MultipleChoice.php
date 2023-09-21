<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultipleChoice extends Model
{
    protected $fillable = [
        'exercise_id' ,
        'question',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'option_5',
        'isCorrect',
    ];

}
