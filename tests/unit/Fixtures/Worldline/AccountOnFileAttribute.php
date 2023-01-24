<?php

declare (strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures\Worldline;

/**
 * Array containing the details of the stored token
 * phpcs:ignoreFile Generic.Files.LineLength.TooLong
 */
final class AccountOnFileAttribute
{
    /**
     * @param string | null $key Name of the key or property
     * @param AccountOnFileAttributeMustWriteReason | null $mustWriteReason Deprecated: This field is not used by any payment product
     *     The reason why the status is MUST_WRITE. Currently only "IN_THE_PAST" is possible as value (for expiry date), but this can be extended with new values in the future.
     * @param AccountOnFileAttributeStatus | null $status Possible values:
     *     * READ_ONLY - attribute cannot be updated and should be presented in that way to the user
     *     * CAN_WRITE - attribute can be updated and should be presented as an editable field, for example an expiration date that will expire very soon
     *     * MUST_WRITE - attribute should be updated and must be presented as an editable field, for example an expiration date that has already expired
     *     Any updated values that are entered for CAN_WRITE or MUST_WRITE will be used to update the values stored in the token.
     * @param string | null $value Value of the key or property
     */
    public function __construct(
        public readonly string|null $key = null,
        public readonly AccountOnFileAttributeMustWriteReason|null $mustWriteReason = null,
        public readonly AccountOnFileAttributeStatus|null $status = null,
        public readonly string|null $value = null,
    ) {
    }
}
