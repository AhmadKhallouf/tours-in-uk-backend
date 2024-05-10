<?php

namespace App\Filament\Employee\Resources;

use App\Enums\PADStatus;
use App\Filament\Components\BaseResource;
use App\Filament\Employee\Actions\ApproveAction;
use App\Filament\Employee\Actions\DeclineAction;
use App\Models\Booking;
use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Str;

abstract class BookingResource extends BaseResource
{
    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function getEloquentQuery(): Builder
    {
        return Booking::query()->where('bookable_type', static::$bookable);
    }

    public static function getNavigationBadge(): ?string
    {
        $pendingBookings = self::getEloquentQuery()->where('status', PADStatus::Pending->value)->count();

        if ($pendingBookings == 0)
            return parent::getNavigationBadge();

        return self::getEloquentQuery()->where('status', PADStatus::Pending->value)->count();
    }


    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getModelLabel(): string
    {
        $name = Str::snake(class_basename(static::$bookable), ' ') . ' booking';
        return parent::getCustomModelLabel($name);
    }

    public static function getPluralModelLabel(): string
    {
        $name = Str::snake(class_basename(static::$bookable), ' ') . ' booking';
        return parent::getCustomPluralModelLabel($name);
    }

    public static function getNavigationGroup(): ?string
    {
        $class_basename = class_basename(static::$bookable) . 'Resource';
        $basename = "App\\Filament\\Employee\\Resources\\$class_basename";

        if (!class_exists($basename))
            return null;

        return app($basename)::getTitleCasePluralModelLabel();
    }

    /**
     * @throws Exception
     */
    private static function addFeaturesToTable(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('partner.name')
                    ->label('Partner')
                    ->sortable()
                    ->searchable()
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(PADStatus::class),
            ])
            ->actions([
                ApproveAction::make(),
                DeclineAction::make(),
//                \Filament\Tables\Actions\ViewAction::make(),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return self::addFeaturesToTable($table);
    }

}
