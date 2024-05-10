<?php

namespace App\Filament\Employee\Widgets;

use App;
use App\Filament\Components\StatusTextColumn;
use App\Filament\Employee\Actions\ApproveAction;
use App\Filament\Employee\Actions\DeclineAction;
use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Support\Htmlable;

class LatestBookings extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected function getTableHeading(): string|Htmlable|null
    {
        $local = App::getLocale();
        if ($local === 'ar')
            return 'آخر الحجوزات';
        return 'Latest bookings';
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(
                Booking::query()->latest()
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),
                TextColumn::make('bookable_type')
                    ->formatStateUsing(function ($state) {
                        return class_basename($state);
                    })
                    ->label('Service type'),
                TextColumn::make('bookable.title')
                    ->label('Service title'),
                TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('guests_count')
                    ->numeric(),
                StatusTextColumn::make('status'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ApproveAction::make(),
                DeclineAction::make(),
            ]);
    }
}
