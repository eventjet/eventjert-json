<?php

declare (strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures\Worldline;

/**
 * Array of attribute keys and their mask
 * phpcs:ignoreFile Generic.Files.LineLength.TooLong
 */
final class LabelTemplateElement
{
    /**
     * @param string | null $attributeKey Name of the attribute that is shown to the customer on selection pages or screens
     * @param string | null $mask Regular mask for the attributeKey
     *     Note: The mask is optional as not every field has a mask
     */
    public function __construct(
        public readonly string|null $attributeKey = null,
        public readonly string|null $mask = null,
    ) {
    }
}
