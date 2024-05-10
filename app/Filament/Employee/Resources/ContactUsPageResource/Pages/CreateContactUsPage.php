<?php

namespace App\Filament\Employee\Resources\ContactUsPageResource\Pages;

use App\Filament\Employee\Resources\ContactUsPageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContactUsPage extends CreateRecord
{
    protected static string $resource = ContactUsPageResource::class;
}
