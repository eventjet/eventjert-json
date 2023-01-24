<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class HasNestedClass
{
    public function __construct(public StringField|null $nested = null)
    {
    }
}
