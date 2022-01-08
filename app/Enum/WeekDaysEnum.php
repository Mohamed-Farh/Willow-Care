<?php


namespace App\Enum;

abstract class WeekDaysEnum
{
    public const SUNDAY = 6;

    public const MONDAY = 0;

    public const TUESDAY = 1;

    public const WEDNESDAY = 2;

    public const THURSDAY = 3;

    public const FRIDAY = 4;

    public const SATURDAY = 5;

    public static function toArray()
    {
        return [
            static::SUNDAY,
            static::MONDAY,
            static::TUESDAY,
            static::WEDNESDAY,
            static::THURSDAY,
            static::FRIDAY,
            static::SATURDAY,
        ];
    }

    public static function getConstantByName($dayName)
    {
        return constant('self::'.$dayName);
    }
}
