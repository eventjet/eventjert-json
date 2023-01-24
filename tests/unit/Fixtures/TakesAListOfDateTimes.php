<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

use DateTimeImmutable;

final class TakesAListOfDateTimes
{
    /**
     * @param list<DateTimeImmutable> $dates
     */
    public function __construct(public readonly array $dates)
    {
    }
}
