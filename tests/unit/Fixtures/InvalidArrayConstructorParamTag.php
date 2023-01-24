<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

use DateTimeImmutable;

final class InvalidArrayConstructorParamTag
{
    /**
     * @param class-string<DateTimeImmutable> items This is not a valid param tag
     * @param list<DateTimeImmutable> $items
     */
    public function __construct(public readonly array $items) // @phpstan-ignore-line
    {
    }
}
