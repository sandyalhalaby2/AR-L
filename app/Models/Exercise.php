<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exercise extends Model
{
    protected $fillable = [
        'lesson_id',
        'type',
        'content',
        'audio_link',
        'image_link'
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
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
