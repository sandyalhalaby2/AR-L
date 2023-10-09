<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrueorFalse extends Model
{
    use HasFactory;

    protected $table = 'true_or_false' ;

    protected $fillable = ['exercise_id','question' , 'is_true' ] ;
}
