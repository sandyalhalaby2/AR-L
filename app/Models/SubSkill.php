<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSkill extends Model
{
    use HasFactory;

    protected $table= 'sub_skills' ;

    protected $fillable = [
        'name' ,
        'description' ,
        'skill_id'
    ];

}
