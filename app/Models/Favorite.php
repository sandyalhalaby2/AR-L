<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites' ;

    protected $fillable = [
        'user_id' ,
        'course_id'
    ] ;


}
