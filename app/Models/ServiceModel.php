<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Schema;
use function Clue\StreamFilter\fun;

class ServiceModel extends Model
{
    protected $hidden = [
        'images'
    ];

    protected $appends = [
        'image_links',
    ];

    public function favoriteBy(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function bookings(): MorphMany
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getImageLinksAttribute(): Collection
    {
        return $this->images()->pluck('link');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('available', function (Builder $query) {
            return $query->available();
        });
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_available', true);
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        if (Schema::hasColumn($this->getTable(), 'last_day')) {
            return $query->whereDate('last_day', '>=', today()->toDateString());
        }

        return $query;
    }

}
