<?php

namespace App\Enums;

enum UserRole: string
{
    case CLIENT = 'client';
    case EMPLOYEE = 'employee';
    case ADMIN = 'admin';

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, ServiceType::cases());
    }
}
