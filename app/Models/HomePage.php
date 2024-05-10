<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HomePage extends PageModel
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = [
        'testimonials',
        'tour1',
        'tour2',
        'tour3',
        'contactSection',
    ];

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    public function tour1(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function tour2(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function tour3(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
