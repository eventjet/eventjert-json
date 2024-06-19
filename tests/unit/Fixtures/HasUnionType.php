<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

use Eventjet\Json\Field;

final class HasUnionType
{
    public function __construct(
        #[Field(converter: PersonVehicleUnion::class)] public readonly Person|Vehicle $value,
    ) {
    }
}
