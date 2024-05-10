<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;

class VipService extends ServiceModel
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot(): void
    {
        parent::boot();

        // TODO: test
        static::addGlobalScope('available', function (Builder $query) {
            $query = $query->available();
            $query = $query->upcoming();
            return $query;
        });
    }


}

