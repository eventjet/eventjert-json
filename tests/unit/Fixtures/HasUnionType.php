<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

use DateInterval;
use DateTimeImmutable;

final class HasUnionType
{
    public function __construct(public readonly DateTimeImmutable|DateInterval $value)
    {
    }
}
