<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

use Eventjet\Json\Converter;
use Eventjet\Json\Json;
use InvalidArgumentException;

use function array_key_exists;
use function is_array;

final class PersonVehicleUnion implements Converter
{
    public static function fromJson(mixed $value): Person|Vehicle
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException('Expected an array');
        }
        if (array_key_exists('full_name', $value)) {
            return Json::instantiateClass(Person::class, $value);
        }
        if (array_key_exists('brand', $value) && array_key_exists('model', $value)) {
            return Json::instantiateClass(Vehicle::class, $value);
        }
        throw new InvalidArgumentException('Invalid value');
    }
}
