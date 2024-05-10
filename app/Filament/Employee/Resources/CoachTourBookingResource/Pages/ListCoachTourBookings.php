<?php

namespace App\Filament\Employee\Resources\CoachTourBookingResource\Pages;

use App\Filament\Employee\Pages\ListBookings;
use App\Filament\Employee\Resources\CoachTourBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoachTourBookings extends ListBookings
{
    protected static string $resource = CoachTourBookingResource::class;

}
