<?php

declare(strict_types=1);

namespace Eventjet\Json\Type;

use function is_bool;

final class Boolean extends JsonType
{
    /**
     * @internal Use {@see JsonType::boolean()} instead.
     */
    public function __construct(public readonly bool|null $value = null)
    {
    }

    /**
     * @internal Use {@see JsonType::true()} instead.
     */
    public static function true(): self
    {
        return new self(true);
    }

    /**
     * @internal Use {@see JsonType::false()} instead.
     */
    public static function false(): self
    {
        return new self(false);
    }

    public function validateDecoded(mixed $value, string $path = ''): ValidationResult
    {
        if ($this->value === null) {
            if (!is_bool($value)) {
                return ValidationResult::error(sprintf('Expected boolean, got %s.', gettype($value)), $path);
            }
            return ValidationResult::valid();
        }
        if ($value === $this->value) {
            return ValidationResult::valid();
        }
        $actual = JsonType::fromDecoded($value);
        return ValidationResult::error(
            sprintf('Expected %s, got %s.', $this->value ? 'true' : 'false', $value ? 'true' : 'false'),
            $path,
        );
    }

    public function __toString(): string
    {
        if ($this->value === null) {
            return 'boolean';
        }
        return $this->value ? 'true' : 'false';
    }
}
