<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

class CoachTour extends ServiceModel
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
