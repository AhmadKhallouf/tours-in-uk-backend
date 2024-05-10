<?php

namespace App\Jobs;

use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateTourDays implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Tour $tour;

    public function __construct(Tour $tour)
    {
        $this->tour = $tour;
    }

    public function handle(): void
    {
        $tour = $this->tour;
        $day = $tour->first_day->copy();

        while ($day->lte($tour->last_day)) {
            $tour->days()->create([
                'date' => $day->copy(), // Use a copy of $day for safety
                'remaining_seats' => $tour->guests_count
            ]);
            $day->addDay();
        }
    }
}
