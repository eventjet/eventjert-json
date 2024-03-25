<?php

declare(strict_types=1);

namespace Eventjet\Json\Type;

use function array_merge;

final class ValidationResult
{
    /**
     * @param list<ValidationIssue> $issues
     */
    public function __construct(public readonly array $issues = [])
    {
    }

    public static function valid(): self
    {
        return new self();
    }

    public static function error(string $message, string $path): self
    {
        return new self([new ValidationIssue($message, $path)]);
    }

    /**
     * @param list<self> $results
     */
    public static function merge(array $results): self
    {
        $issues = [];
        foreach ($results as $result) {
            $issues[] = $result->issues;
        }
        return new self(array_merge([], ...$issues));
    }

    public function isValid(): bool
    {
        return $this->issues === [];
    }
}
