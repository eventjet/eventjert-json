<?php

declare(strict_types=1);

namespace Eventjet\Json\Type;

use function array_is_list;
use function sprintf;

final class Array_ extends JsonType
{
    /**
     * @internal Use {@see JsonType::array()} instead.
     */
    public function __construct(public readonly JsonType $elementType)
    {
    }

    public function __toString(): string
    {
        return sprintf('array<%s>', $this->elementType);
    }

    public function validateDecoded(mixed $value, string $path = ''): ValidationResult
    {
        if (!is_array($value)) {
            return ValidationResult::error(sprintf('Expected array, got %s.', JsonType::fromDecoded($value)), $path);
        }
        if (!array_is_list($value)) {
            return ValidationResult::error('Expected array, got object.', $path);
        }
        $results = [];
        foreach ($value as $key => $element) {
            $results[] = $this->elementType->validateDecoded($element, self::joinPath($path, $key));
        }
        if ($results === []) {
            return ValidationResult::valid();
        }
        return ValidationResult::merge($results);
    }
}
