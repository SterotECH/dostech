<?php

namespace App\Enums;

enum HouseName: string
{
    case CARDINAL_APPIAH_TURKSON = 'Cardinal Appiah Turkson';
    case BISHOP_AFRIFA_AGYEKUM = 'Bishop Afrifa Agyekum';
    case ARCHBISHOP_PALMER_BUCKLE = 'Archbishop Palmer Buckle';
    case BISHOP_GABRIEL_EDDOE_KUMORDZIE = 'Bishop Gabriel Eddoe Kumordzie';
    case WHITE_HOUSE = 'White House';

    public function displayName(): string
    {
        return match ($this) {
            self::CARDINAL_APPIAH_TURKSON => 'Cardinal Appiah Turkson',
            self::BISHOP_AFRIFA_AGYEKUM => 'Bishop Afrifa Agyekum',
            self::ARCHBISHOP_PALMER_BUCKLE => 'Archbishop Palmer Buckle',
            self::BISHOP_GABRIEL_EDDOE_KUMORDZIE => 'Bishop Gabriel Eddoe Kumordzie',
            self::WHITE_HOUSE => 'White House',
        };
    }
}
