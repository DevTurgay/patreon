<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['text'];

    public function read(): HasOne
    {
        return $this->hasOne(NotificationRead::class);
    }
}
