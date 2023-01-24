<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

use Eventjet\Json\Item;

final class PersonList
{
    /**
     * @param list<Person> $people
     */
    public function __construct(#[Item(Person::class)] public array $people = [])
    {
    }
}
