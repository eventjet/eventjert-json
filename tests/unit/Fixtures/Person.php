<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

use Eventjet\Json\Field;

final class Person
{
    public function __construct(
        #[Field('full_name')] public string $fullName = '',
        public int $age = 0,
    ) {
    }
}
