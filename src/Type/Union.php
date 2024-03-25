<?php

declare(strict_types=1);

namespace Eventjet\Json\Type;

use Stringable;
use function array_slice;
use function array_values;
use function count;
use function ksort;
use const SORT_STRING;

final class Union extends JsonType
{
    /** @var list<JsonType> */
    public readonly array $types;

    /**
     * @no-named-arguments
     * @internal Use {@see JsonType::union()} or the instance method {@see JsonType::or()} instead.
     */
    public function __construct(JsonType ...$types)
    {
        $this->types = $types;
    }

    /**
     * @param non-empty-array<array-key, string | Stringable> $parts
     */
    private static function disjunction(array $parts): string
    {
        if (count($parts) === 1) {
            return (string)$parts[0];
        }
        $commaSeparated = implode(', ', array_slice($parts, 0, -1));
        return $commaSeparated . ' or ' . $parts[count($parts) - 1];
    }

    public function __toString(): string
    {
        return implode(' | ', $this->types);
    }

    public function validateDecoded(mixed $value, string $path = ''): ValidationResult
    {
        $errors = [];
        foreach ($this->types as $type) {
            $result = $type->validateDecoded($value, $path);
            if ($result->isValid()) {
                return $result;
            }
            $errors[] = $result;
        }
        $expected = self::disjunction($this->canonicalize()->types);
        return ValidationResult::error(
            sprintf('Expected %s, got %s.', $expected, JsonType::fromDecoded($value)),
            $path,
            ...$errors,
        );
    }

    public function canonicalize(): JsonType
    {
        $types = [];
        foreach ($this->types as $type) {
            $type = $type->canonicalize();
            $types[(string)$type] = $type;
        }
        ksort($types, SORT_STRING);
        return new self(...array_values($types));
    }

}
