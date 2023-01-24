<?php

declare(strict_types=1);

namespace Eventjet\Test\Unit\Json\Fixtures\GitHub;

use Eventjet\Json\Field;

final class Repository
{
    /**
     * @param list<string> | null $topics
     */
    public function __construct(
        public int $id = 0,
        #[Field('node_id')]
        public string $nodeId = '',
        public string $name = '',
        #[Field('full_name')]
        public string $fullName = '',
        public RepositoryOwner $owner = new RepositoryOwner(),
        public bool $private = false,
        public string|null $language = null,
        public array|null $topics = [],
    ) {
    }
}
