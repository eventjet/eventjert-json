<?php

declare (strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures\Worldline;

/**
 * Object containing information for the client on how best to display this field
 * phpcs:ignoreFile Generic.Files.LineLength.TooLong
 */
final class AccountOnFileDisplayHints
{
    /**
     * @param list<LabelTemplateElement> | null $labelTemplate Array of attribute keys and their mask
     * @param string | null $logo Partial URL that you can reference for the image of this payment product. You can use our server-side resize functionality by appending '?size={{width}}x{{height}}' to the full URL, where width and height are specified in pixels. The resized image will always keep its correct aspect ratio.
     */
    public function __construct(
        public readonly array|null $labelTemplate = null,
        public readonly string|null $logo = null,
    ) {
    }
}
