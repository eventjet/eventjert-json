<?php

declare(strict_types=1);

namespace Eventjet\Json\Type;

final class Member
{
    private function __construct(public readonly JsonType $type, public readonly bool $required)
    {
    }

    public static function required(JsonType $type): self
    {
        return new self($type, true);
    }

    public static function optional(JsonType $type): self
    {
        return new self($type, false);
    }

    public function withCanonicalizedType(): self
    {
        return new self($this->type->canonicalize(), $this->required);
    }
}
