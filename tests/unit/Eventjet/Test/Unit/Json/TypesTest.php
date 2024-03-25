<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json;

use Eventjet\Json\Type\JsonType;
use Eventjet\Json\Type\Member;
use Eventjet\Json\Type\ValidationIssue;
use Eventjet\Json\Type\ValidationResult;
use PHPUnit\Framework\TestCase;
use function sprintf;

final class TypesTest extends TestCase
{
    /**
     * @return iterable<string, array{JsonType, string, list<ValidationIssue>}>
     */
    public static function validateCases(): iterable
    {
        $cases = [
            [JsonType::string(), '"foo"', []],
            [JsonType::string(), '""', []],
            [JsonType::string(), '42', [new ValidationIssue('Expected string, got integer.', '')]],

            [JsonType::number(), '42', []],
            [JsonType::number(), '3.14', []],
            [JsonType::number(), '"42"', [new ValidationIssue('Expected number, got string.', '')]],

            [JsonType::array(JsonType::string()), '["foo", "bar"]', []],
            [JsonType::array(JsonType::string()), '[]', []],
            [JsonType::array(JsonType::string()), '[42]', [
                new ValidationIssue('Expected string, got integer.', '0'),
            ]],

            [JsonType::boolean(), 'true', []],
            [JsonType::boolean(), 'false', []],
            [JsonType::boolean(), '"true"', [
                new ValidationIssue('Expected boolean, got string.', ''),
            ]],

            [JsonType::true(), 'true', []],
            [JsonType::true(), 'false', [new ValidationIssue('Expected true, got false.', '')]],

            [JsonType::false(), 'false', []],
            [JsonType::false(), 'true', [new ValidationIssue('Expected false, got true.', '')]],

            [JsonType::null(), 'null', []],
            [JsonType::null(), 'false', [new ValidationIssue('Expected null, got false.', '')]],

            [JsonType::union(JsonType::string(), JsonType::null()), '"foo"', []],
            [JsonType::union(JsonType::string(), JsonType::null()), 'null', []],
            [JsonType::union(JsonType::string(), JsonType::null()), '42', [
                new ValidationIssue('Expected null or string, got number.', ''),
            ]],

            [JsonType::object(['name' => Member::required(JsonType::string())]), '{"name": "John"}', []],
            [JsonType::object(['name' => Member::optional(JsonType::string())]), '{}', []],
            [JsonType::object(['name' => Member::required(JsonType::string())]), '{}', [
                new ValidationIssue('Missing required member.', 'name'),
            ]],
            [JsonType::object(['name' => Member::required(JsonType::string())]), '{"name": 42}', [
                new ValidationIssue('Expected string, got integer.', 'name'),
            ]],
            [JsonType::object(['name' => Member::optional(JsonType::string())]), '{"name": 42}', [
                new ValidationIssue('Expected string, got integer.', 'name'),
            ]],
        ];
        foreach ($cases as [$type, $json, $expected]) {
            yield sprintf('%s, %s', $type, $json) => [$type, $json, $expected];
        }
    }

    /**
     * @param list<ValidationIssue> $issues
     */
    private static function arrayContainsIssue(array $issues, ValidationIssue $expected): bool
    {
        foreach ($issues as $issue) {
            if (!$issue->equals($expected)) {
                continue;
            }
            return true;
        }
        return false;
    }

    /**
     * @param list<ValidationIssue> $issues
     */
    private static function assertIssueInList(ValidationIssue $expected, array $issues): void
    {
        self::assertTrue(
            self::arrayContainsIssue($issues, $expected),
            sprintf('Expected issue %s not found.', $expected),
        );
    }

    /**
     * @param list<ValidationIssue> $expectedIssues
     */
    private static function expectIssues(ValidationResult $actual, array $expectedIssues): void
    {
        self::assertFalse($actual->isValid(), 'Expected validation to fail, but it succeeded.');
        self::assertCount(count($expectedIssues), $actual->issues, sprintf('Expected %d issues, but got %d.', count($expectedIssues), count($actual->issues)));

        foreach ($expectedIssues as $expectedIssue) {
            self::assertIssueInList($expectedIssue, $actual->issues);
        }
    }

    /**
     * @param list<ValidationIssue> $expectedIssues
     * @dataProvider validateCases
     */
    public function testValidate(JsonType $type, string $json, array $expectedIssues = []): void
    {
        $result = $type->validate($json);

        if ($expectedIssues === []) {
            self::assertTrue(
                $result->isValid(),
                sprintf('Expected %s to validate against %s, but got errors: %s', $json, $type, $result->issues),
            );
        } else {
            self::expectIssues($result, $expectedIssues);
        }
    }
}
