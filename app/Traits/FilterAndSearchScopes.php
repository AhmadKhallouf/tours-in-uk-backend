<?php

namespace App\Traits;

use Carbon\Carbon;
use Date;
use Illuminate\Database\Eloquent\Builder;

trait FilterAndSearchScopes
{
    public function scopeApplyDateFilter(Builder $query, $startDate = null, $endDate = null): Builder
    {
        if ($startDate) {
            $startDate = $startDate instanceof Carbon ? $startDate : new Carbon($startDate);
            $query = $query->where('last_day', '>=', $startDate);
        }
        if ($endDate) {
            $endDate = $endDate instanceof Carbon ? $endDate : new Carbon($endDate);
            $query = $query->where('first_day', '<=', $endDate);
        }

        return $query;
    }

    public function scopeApplyPriceFilter(Builder $query, $minPrice = null, $maxPrice = null): Builder
    {
        if ($minPrice) {
            $query = $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query = $query->where('price', '<=', $maxPrice);
        }

        return $query;
    }

    public function scopeApplyMinimumGuestsFilter(Builder $query, $seats): Builder
    {
        if ($seats) {
            return $query->whereHas('days', function ($subQuery) use ($seats) {
                $subQuery->where('guests_count', '>=', $seats);
            });
        }
        return $query;
    }

    public function scopeApplyCityFilter(Builder $query, $city): Builder
    {
        if ($city) {
            return $query->where('city', $city);
        }
        return $query;
    }
}





















