<?php

declare(strict_types=1);

namespace Eventjet\Json\Type;

final class Null_ extends JsonType
{
    /**
     * @internal Use {@see JsonType::null()} instead.
     */
    public function __construct()
    {
    }

    public function __toString(): string
    {
        return 'null';
    }

    public function validateDecoded(mixed $value, string $path = ''): ValidationResult
    {
        if ($value === null) {
            return ValidationResult::valid();
        }
        return ValidationResult::error(sprintf('Expected null, got %s.', JsonType::fromDecoded($value)), $path);
    }
}
