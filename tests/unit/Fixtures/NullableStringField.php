<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class NullableStringField
{
    public function __construct(public string|null $name = null)
    {
    }
}
