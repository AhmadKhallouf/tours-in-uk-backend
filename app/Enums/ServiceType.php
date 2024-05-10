<?php

namespace App\Enums;

enum ServiceType: string
{
    case TOUR = 'tour';
    case VIP_SERVICE = 'vip_service';
    case COACH_TOUR = 'coach_tour';

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, ServiceType::cases());
    }
}
