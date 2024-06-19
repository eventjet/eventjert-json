<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class Vehicle
{
    public function __construct(public readonly string $brand, public readonly string $model)
    {
    }
}
