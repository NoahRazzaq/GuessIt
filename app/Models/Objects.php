<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Objects extends Model
{

    use \Illuminate\Database\Eloquent\Factories\HasFactory;


    protected $fillable = [
        'name',
        'description',
        'image_path',
        'real_price',
        'category_id',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function guesses(): HasMany
    {
        return $this->hasMany(Guess::class);
    }
}
