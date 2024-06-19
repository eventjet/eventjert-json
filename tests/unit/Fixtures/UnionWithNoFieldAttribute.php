<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class UnionWithNoFieldAttribute
{
    public function __construct(
        public readonly Person|Vehicle $value,
    ) {
    }
}
