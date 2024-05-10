<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Partner;

class PriceService
{
    public static function getShares($totalPrice, ?Partner $partner = null): array
    {
        $partnerPercentage = $partner ? $partner->commission_percentage : 0;

        // Assuming that it's a percent
        $partnerPercentage /= 100;

        return [
            'company_share' => $totalPrice * (1 - $partnerPercentage),
            'partner_share' => $totalPrice * $partnerPercentage,
        ];
    }
}
