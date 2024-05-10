<?php

namespace App\Filament\Employee\Actions;

use App\Models\Booking;
use App\Models\CoachTour;
use App\Models\Tour;
use App\Models\VipService;
use App\Services\CoachTourBookingService;
use App\Services\TourBookingService;
use App\Services\VipServiceBookingService;
use Exception;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class ApproveAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return __('filament-panels::resources/labels.Approve.label');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(ucfirst(__('filament-panels::resources/labels.Approve.label')));

        $this->successNotificationTitle(__('filament-panels::resources/labels.Approve.success'));

        $this->failureNotificationTitle(__('filament-panels::resources/labels.Approve.failure'));

        $this->icon('heroicon-m-check');

        $this->color('success');

        $this->hidden(function (array $data, Model $record, Table $table) {
            return ($record->getAttribute('status') !== 'pending');
        });

        $this->action(function (array $data, Model $record, Table $table) {
            try {
                if (!$record instanceof Booking)
                    throw new Exception('Record is not a booking.');

                $bookingService = match (true) {
                    $record->bookable_type == Tour::class => new TourBookingService(),
                    $record->bookable_type == VipService::class => new VipServiceBookingService(),
                    $record->bookable_type == CoachTour::class => new CoachTourBookingService(),
                    default => throw new Exception('Booking does not belong to a service.'),
                };

                $bookingService::approve($record);
                // TODO: send email to user
                // TODO: tell user to pay
                $this->success();

            } catch (Throwable $exception) {
                $this->failure();
            }
        });
    }

}
