<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class TakesMultilineList
{
    /**
     * @param list<
     *     string
     * > $items
     */
    public function __construct(public readonly array $items)
    {
    }
}
