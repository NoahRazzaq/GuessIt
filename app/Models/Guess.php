<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Guess extends Model
{

    use \Illuminate\Database\Eloquent\Factories\HasFactory;


    protected $fillable = [
        'user_id',
        'object_id',
        'guessed_price',
        'score',
        'time_taken',
        'attempt_number',
        'feedback',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function object(): BelongsTo
    {
        return $this->belongsTo(Objects::class);
    }
}
