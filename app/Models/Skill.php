<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['description' , 'type'  , 'level_id'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function subSkills()
    {
        return $this->hasMany(SubSkill::class , 'skill_id');
    }

}

