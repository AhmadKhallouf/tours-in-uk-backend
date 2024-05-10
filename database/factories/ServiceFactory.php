<?php

namespace Database\Factories;

use App\Services\RandImageProviderService;
use Illuminate\Database\Eloquent\Factories\Factory;

abstract class ServiceFactory extends Factory
{
    public function withImages(): ServiceFactory
    {
        return $this->afterCreating(function ($model) {
            if (method_exists($model, 'images')) {
                $imagesCount = 5;
                for ($i = 0; $i < $imagesCount; $i++) {
                    $model->images()->create([
                        'link' => RandImageProviderService::getRandomImage(),
                    ]);
                }
            }
        });
    }
}
