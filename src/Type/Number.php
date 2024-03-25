<?php

declare(strict_types=1);

namespace Eventjet\Json\Type;

final class Number extends JsonType
{
    /**
     * @internal Use {@see JsonType::number()} instead.
     */
    public function __construct()
    {
    }

    public function __toString(): string
    {
        return 'number';
    }

    public function validateDecoded(mixed $value, string $path = ''): ValidationResult
    {
        if (is_int($value) || is_float($value)) {
            return ValidationResult::valid();
        }
        return ValidationResult::error(sprintf('Expected number, got %s.', JsonType::fromDecoded($value)), $path);
    }
}
