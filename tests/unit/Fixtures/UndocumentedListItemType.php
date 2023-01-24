<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class UndocumentedListItemType
{
    /**
     * This is the constructor. The type of the items for $items is not documented.
     */
    public function __construct(public readonly array $items) // @phpstan-ignore-line
    {
    }
}
