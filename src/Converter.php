<?php

declare(strict_types=1);

namespace Eventjet\Json;

interface Converter
{
    public static function fromJson(mixed $value): mixed;
}
