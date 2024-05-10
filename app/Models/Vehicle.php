<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot(): void
    {
        parent::boot();
//        static::addGlobalScope('available', function (Builder $query) {
//            return $query->where('is_available', true);
//        });
    }
}
