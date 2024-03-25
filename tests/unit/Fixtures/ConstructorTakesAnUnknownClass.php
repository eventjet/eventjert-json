<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

use DoesNotExist;

final class ConstructorTakesAnUnknownClass
{
    public function __construct(public readonly DoesNotExist $foo) // @phpstan-ignore-line
    {
    }
}
