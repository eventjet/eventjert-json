<?php

declare (strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures\Worldline;

/**
 * Object containing information for the client on how best to display this field
 * phpcs:ignoreFile Generic.Files.LineLength.TooLong
 */
final class AccountOnFile
{
    /**
     * @param list<AccountOnFileAttribute> | null $attributes
     * @param int | null $paymentProductId Payment product identifier - Please see Products documentation for a full overview of possible values.
     */
    public function __construct(
        public readonly array|null $attributes = null,
        public readonly AccountOnFileDisplayHints|null $displayHints = null,
        public readonly int|null $id = null,
        public readonly int|null $paymentProductId = null,
    ) {
    }
}
