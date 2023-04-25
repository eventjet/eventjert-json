<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class HasMapOfObjects
{
    /**
     * @param array<string, StringField> $map
     */
    public function __construct(public readonly array $map)
    {
    }
}
