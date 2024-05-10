<?php

namespace App\Models;

use App\Jobs\CreateTourDays;
use App\Traits\FilterAndSearchScopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use LaravelIdea\Helper\App\Models\_IH_Tour_QB;

class Tour extends ServiceModel
{
    use HasFactory, FilterAndSearchScopes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = [
        'images',
        'activities',
        'events',
    ];

    protected $appends = [
        'image_links'
    ];

    protected $casts = [
        'first_day' => 'date',
        'last_day' => 'date',
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    public function scopeApplyFilters(Builder|_IH_Tour_QB $query, array $input)
    {
        $query = $query->applyCityFilter(
            array_key_exists('city', $input) ? $input['city'] : null
        );
        $query = $query->applyDateFilter(
            array_key_exists('start_date', $input) ? $input['start_date'] : null,
            array_key_exists('end_date', $input) ? $input['end_date'] : null
        );
        $query = $query->applyPriceFilter(
            array_key_exists('min_price', $input) ? $input['min_price'] : null,
            array_key_exists('max_price', $input) ? $input['max_price'] : null
        );
        $query = $query->applyMinimumGuestsFilter(
            array_key_exists('guests_count', $input) ? $input['guests_count'] : null
        );

        return $query;
    }


    protected static function boot(): void
    {
        parent::boot();

        static::created(function (Tour $tour) {
            // TODO: disable job
            // the following line is commented out because
            // I didn't know how to run job worker on shared hosting
//            dispatch(new CreateTourDays($tour));
            $tour->createTourDays();
            //TODO get city
        });
    }

    private function createTourDays(): void
    {
        // Clone the first_day to avoid modifying the original instance
        $day = $this->first_day->copy();

        while ($day->lte($this->last_day)) {
            $this->days()->create([
                'date' => $day->copy(), // Use a copy of $day for safety
                'remaining_seats' => $this->guests_count
            ]);
            $day->addDay();
        }
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class)->orderBy('order');
    }

    public function days(): HasMany
    {
        return $this->hasMany(Day::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
