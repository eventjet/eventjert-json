<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures;

final class PromotedPropertyWithMissingType
{
    /**
     * @psalm-suppress MissingParamType
     * @phpstan-ignore-next-line
     */
    public function __construct(public $nested = null)
    {
    }
}
