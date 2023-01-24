<?php

declare (strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures\Worldline;

/**
 *  * phpcs:ignoreFile Generic.Files.LineLength.TooLong
 */
enum AccountOnFileAttributeStatus: string
{
    case ReadOnly = 'READ_ONLY';
    case CanWrite = 'CAN_WRITE';
    case MustWrite = 'MUST_WRITE';
}
