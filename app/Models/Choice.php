<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'is_correct'];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Skill::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
