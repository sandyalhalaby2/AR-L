<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchThePair extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id',
        'question' ,
        'pair_1_item_a', 'pair_1_item_b',
        'pair_2_item_a', 'pair_2_item_b',
        'pair_3_item_a', 'pair_3_item_b',
        'pair_4_item_a', 'pair_4_item_b',
        'pair_5_item_a', 'pair_5_item_b'
    ];
}
