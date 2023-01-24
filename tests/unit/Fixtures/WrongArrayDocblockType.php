<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

use DateTimeImmutable;

final class WrongArrayDocblockType
{
    /**
     * @psalm-suppress MismatchingDocblockParamType
     * @param class-string<DateTimeImmutable> $items
     */
    public function __construct(public readonly array $items) // @phpstan-ignore-line
    {
    }
}
