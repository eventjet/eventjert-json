<?php

declare(strict_types=1);

namespace Eventjet\Json;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class Field
{
    public function __construct(public readonly string $name)
    {
    }
}
