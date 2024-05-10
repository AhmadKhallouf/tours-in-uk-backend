<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Artisan;

abstract class ContentModel extends Model
{
    protected static function boot(): void
    {
        parent::boot();

        static::saved(function () {
            Artisan::call('cache:clear');
        });

        static::deleted(function () {
            Artisan::call('cache:clear');
        });
    }
}
