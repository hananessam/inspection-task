<?php

namespace Modules\Team\Enums;

enum DayOfWeekEnum: string
{
    case MONDAY = '0';
    case TUESDAY = '1';
    case WEDNESDAY = '2';
    case THURSDAY = '3';
    case FRIDAY = '4';
    case SATURDAY = '5';
    case SUNDAY = '6';

    public function toString(): string
    {
        return match ($this) {
            self::MONDAY => 'Monday',
            self::TUESDAY => 'Tuesday',
            self::WEDNESDAY => 'Wednesday',
            self::THURSDAY => 'Thursday',
            self::FRIDAY => 'Friday',
            self::SATURDAY => 'Saturday',
            self::SUNDAY => 'Sunday',
        };
    }

    public static function getValues(): array
    {
        return array_map(fn($day) => $day->value, self::cases());
    }
}
