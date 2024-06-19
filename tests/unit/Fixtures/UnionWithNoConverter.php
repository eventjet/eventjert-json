<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

use Eventjet\Json\Field;

final class UnionWithNoConverter
{
    public function __construct(
        #[Field(name: 'value')] public readonly Person|Vehicle $value,
    ) {
    }
}
