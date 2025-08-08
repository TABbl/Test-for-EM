<?php

declare(strict_types=1);

namespace App\Enums\Tasks;

use Illuminate\Validation\Rules\Enum;

final class TaskStatusEnum extends Enum
{
    public const AWAITING = 1;
    public const IN_PROGRESS = 2;
    public const COMPLETED = 3;

    private static array $STRINGS = [
        self::AWAITING => 'awaiting',
        self::IN_PROGRESS => 'in_progress',
        self::COMPLETED => 'completed',
    ];

    public static function getStrings(): array
    {
        return self::$STRINGS;
    }

    public static function toStr(int $v): string
    {
        return $v >= 1 && $v <= count(self::$STRINGS) ? self::$STRINGS[$v] : '';
    }

    public static function fromString(string $key): ?int
    {
        $index = array_search($key, self::$STRINGS);
        return $index === false ? null : $index;
    }
}
