<?php

declare(strict_types=1);

namespace Eventjet\Json;

use RuntimeException;
use Throwable;

final class JsonError extends RuntimeException
{
    private function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function encodeFailed(string $message, Throwable|null $previous = null): self
    {
        return new self($message, previous: $previous);
    }

    public static function decodeFailed(string|null $message, Throwable|null $previous = null): self
    {
        return new self($message ?? 'JSON decoding failed', previous: $previous);
    }
}
