<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class TakesStringStringMap
{
    /**
     * @param array<string, string> $map
     */
    public function __construct(public readonly array $map)
    {
    }
}
