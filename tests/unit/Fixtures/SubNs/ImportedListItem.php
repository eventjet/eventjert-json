<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures\SubNs;

final class ImportedListItem
{
    public function __construct(public readonly string $name)
    {
    }
}
