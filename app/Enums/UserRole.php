<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum UserRole: string
{
    case HOUSE_MASTER = 'house_master';
    case ADMINISTRATOR = 'admin';
    case USER = 'user';

    public function label()
    {
        return match ($this) {
            self::ADMINISTRATOR => 'Administrator',
            self::HOUSE_MASTER => 'House Master',
            self::USER => 'User'
        };
    }

    public function color()
    {
        return match ($this) {
            self::ADMINISTRATOR => 'bg-green-100 text-green-800',
            self::HOUSE_MASTER => 'bg-yellow-100 text-yellow-800',
            self::USER => 'bg-blue-100 text-blue-800'
        };
    }
}
