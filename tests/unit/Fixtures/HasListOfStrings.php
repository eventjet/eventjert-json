<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class HasListOfStrings
{
    /**
     * @param list<string> $tags
     */
    public function __construct(public readonly array $tags)
    {
    }
}
