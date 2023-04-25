<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class TakesMapOrNull
{
    /**
     * @param array<string, StringField> | null $map
     */
    public function __construct(public readonly array|null $map)
    {
    }
}
