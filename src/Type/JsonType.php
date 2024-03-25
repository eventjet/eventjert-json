<?php

declare(strict_types=1);

namespace Eventjet\Json\Type;

use Stringable;
use function array_is_list;
use function array_values;
use function gettype;
use function json_decode;
use function json_last_error;
use const JSON_ERROR_NONE;

abstract class JsonType implements Stringable
{
    public static function array(JsonType $elementType): Array_
    {
        return new Array_($elementType);
    }

    public static function boolean(): Boolean
    {
        return new Boolean();
    }

    public static function false(): Boolean
    {
        return Boolean::false();
    }

    public static function null(): Null_
    {
        return new Null_();
    }

    public static function number(): Number
    {
        return new Number();
    }

    /**
     * @param array<string, Member> $members
     */
    public static function object(array $members = []): Object_
    {
        return new Object_($members);
    }

    public static function string(): String_
    {
        return new String_();
    }

    public static function true(): Boolean
    {
        return Boolean::true();
    }

    public static function union(JsonType ...$types): Union
    {
        return new Union(...$types);
    }

    public static function fromDecoded(mixed $value): self
    {
        return match (gettype($value)) {
            'array' => array_is_list($value)
                ? self::arrayFromDecoded($value)
                : self::objectFromDecoded($value),
            'boolean' => $value ? static::true() : static::false(),
            'string' => static::string(),
            'double', 'integer' => static::number(),
            'NULL' => static::null(),
        };
    }

    /**
     * @param list<mixed> $elements
     */
    private static function arrayFromDecoded(array $elements): Array_
    {
        $elementTypes = [];
        foreach ($elements as $element) {
            $type = self::fromDecoded($element);
            $elementTypes[(string)$type] = $type;
        }
        return self::array(self::union(...array_values($elementTypes)));
    }

    /**
     * @param array<array-key, mixed> $value
     */
    private static function objectFromDecoded(array $value): Object_
    {
        $members = [];
        foreach ($value as $key => $element) {
            $members[(string)$key] = Member::required(self::fromDecoded($element));
        }
        return self::object($members);
    }

    protected static function joinPath(string $prefix, string|int $key): string
    {
        return $prefix === '' ? (string)$key : $prefix . '.' . $key;
    }

    abstract public function validateDecoded(mixed $value, string $path = ''): ValidationResult;

    public function or(self $other): Union
    {
        return new Union($this, $other);
    }

    final function validate(string $json): ValidationResult
    {
        $decoded = json_decode($json, true);
        if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
            return ValidationResult::error('Invalid JSON', '');
        }
        return static::validateDecoded($decoded, '');
    }

    /**
     * The canonicalize method is used to obtain the canonical form of the type. Two types are considered
     * equal if their canonical forms are equal. This method, when used in conjunction with the __toString()
     * method, allows for comparing types. For instance, the types "string | number" and "number | string"
     * are considered equal because their canonical forms are equal. The method returns the canonical form of
     * the type.
     */
    public function canonicalize(): self
    {
        return $this;
    }
}
