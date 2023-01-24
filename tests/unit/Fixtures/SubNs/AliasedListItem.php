<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures\SubNs;

final class AliasedListItem
{
    public function __construct(public readonly string $name)
    {
    }
}
