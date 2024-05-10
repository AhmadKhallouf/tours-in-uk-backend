<?php

namespace App\Filament\Employee\Resources\TourBookingResource\Pages;

use App\Filament\Employee\Pages\ListBookings;
use App\Filament\Employee\Resources\TourBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTourBookings extends ListBookings
{
    protected static string $resource = TourBookingResource::class;

}
