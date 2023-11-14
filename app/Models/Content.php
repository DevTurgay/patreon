<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['is_released', 'user_id', 'title', 'text', 'release_date', 'price'];

    public function scopeIsReleased($query)
    {
        return $query->where('is_released', true);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
