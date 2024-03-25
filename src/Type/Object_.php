<?php

declare(strict_types=1);

namespace Eventjet\Json\Type;

use function array_key_exists;

final class Object_ extends JsonType
{
    /**
     * @param array<string, Member> $members
     * @internal Use {@see JsonType::object()} instead.
     */
    public function __construct(public readonly array $members)
    {
    }

    public function __toString(): string
    {
        $members = [];
        foreach ($this->members as $name => $member) {
            $members[] = sprintf('%s%s: %s', $name, $member->required ? '' : '?', $member->type);
        }
        return sprintf('{%s}', implode(', ', $members));
    }

    public function validateDecoded(mixed $value, string $path = ''): ValidationResult
    {
        if (!is_array($value)) {
            return ValidationResult::error(sprintf('Expected object, got %s.', JsonType::fromDecoded($value)), $path);
        }
        $results = [];
        foreach ($this->members as $name => $member) {
            if (!array_key_exists($name, $value)) {
                if (!$member->required) {
                    continue;
                }
                $results[] = ValidationResult::error('Missing required member.', self::joinPath($path, $name));
                continue;
            }
            $results[] = $member->type->validateDecoded($value[$name], self::joinPath($path, $name));
        }
        if ($results === []) {
            return ValidationResult::valid();
        }
        return ValidationResult::merge($results);
    }
}
