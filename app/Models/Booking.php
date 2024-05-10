<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Booking extends Model
{

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    // Booking belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookable(): MorphTo
    {
        return $this->morphTo();
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}
