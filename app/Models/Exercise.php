<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exercise extends Model
{
    protected $fillable = [
        'sub_skill_id',
        'content',
        'audio_link',
        'image_link',
        'xp'
    ];

    public function sub_skill(): BelongsTo
    {
        return $this->belongsTo(SubSkill::class);
    }

    public function multipleChoice()
    {
        return $this->hasOne(MultipleChoice::class);
    }

    public function fillInTheBlank()
    {
        return $this->hasOne(FillInTheBlank::class);
    }

    public function matchThePair()
    {
        return $this->hasOne(MatchThePair::class);
    }

    public function trueOrFalse()
    {
        return $this->hasOne(TrueorFalse::class);
    }
    public function completetheletter()
    {
        return $this->hasOne(CompleteTheLetter::class);
    }


    public function hascompletetheletter()
    {
        return $this->hasOne(CompleteTheLetter::class)->exists();
    }

    public function hastrueOrFalse()
    {
        return $this->hasOne(TrueorFalse::class)->exists();
    }

    public function hasMultipleChoice(): bool
    {
        return $this->multipleChoice()->exists();
    }

    public function hasFillInTheBlank(): bool
    {
        return $this->fillInTheBlank()->exists();
    }

    public function hasMatchThePair(): bool
    {
        return $this->matchThePair()->exists();
    }
}
