<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteTheLetter extends Model
{
    use HasFactory;
    protected $table = 'complete_the_letter' ;
    protected $fillable = [
        'exercise_id' ,
        'question',
        'sentence_with_blank',
        'letters',
        'sorted_letters',
    ];
}
