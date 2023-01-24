<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class SomePropertiesAreNotConstructorArguments
{
    public int|null $age = null;

    public function __construct(public readonly string $name)
    {
    }
}
