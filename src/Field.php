<?php

declare(strict_types=1);

namespace Eventjet\Json;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
final class Field
{
    /**
     * @param class-string<Converter>|null $converter
     */
    public function __construct(
        public readonly string|null $name = null,
        public readonly string|null $converter = null,
    ) {
    }
}
