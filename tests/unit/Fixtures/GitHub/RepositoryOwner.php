<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures\GitHub;

use Eventjet\Json\Field;

final class RepositoryOwner
{
    public function __construct(
        public string|null $name = null,
        public string|null $email = null,
        public string $login = '',
        public int $id = 0,
        #[Field('node_id')] public string $nodeId = '',
    ) {
    }
}
