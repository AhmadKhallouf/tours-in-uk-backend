<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;

abstract class PageModel extends ContentModel
{
    protected $hidden = ['heroImages'];

    protected $appends = [
        'hero_image_links'
    ];

    public function contactSection(): BelongsTo
    {
        return $this->belongsTo(ContactSection::class);
    }

    public function heroImages(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getHeroImageLinksAttribute(): Collection
    {
        return $this->heroImages()->pluck('link');
    }
}
