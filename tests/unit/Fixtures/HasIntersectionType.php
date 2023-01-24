<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class HasIntersectionType
{
    public function __construct(public readonly EmptyInterfaceA&EmptyInterfaceB $value)
    {
    }
}
