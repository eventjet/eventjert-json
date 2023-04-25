<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class UndocumentedMap
{
    public function __construct(public readonly array $map) // @phpstan-ignore-line
    {
    }
}
