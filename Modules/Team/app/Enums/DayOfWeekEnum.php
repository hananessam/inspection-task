<?php

namespace Modules\Team\Enums;

enum DayOfWeekEnum: string
{
    case SUNDAY = '0';
    case MONDAY = '1';
    case TUESDAY = '2';
    case WEDNESDAY = '3';
    case THURSDAY = '4';
    case FRIDAY = '5';
    case SATURDAY = '6';

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
