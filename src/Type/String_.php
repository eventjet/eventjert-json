<?php

declare(strict_types=1);

namespace Eventjet\Json\Type;

use function sprintf;

final class String_ extends JsonType
{
    /**
     * @internal Use {@see JsonType::string()} instead.
     */
    public function __construct()
    {
    }

    public function validateDecoded(mixed $value, string $path = ''): ValidationResult
    {
        if (!is_string($value)) {
            return ValidationResult::error(sprintf('Expected string, got %s.', gettype($value)), $path);
        }
        return ValidationResult::valid();
    }

    public function __toString(): string
    {
        return 'string';
    }
}
