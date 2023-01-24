# eventjet/json
Type-safe JSON parsing and encoding for PHP.

While PHP's native `json_parse()` outputs plain arrays or stdClass objects, this library allows you to decode JSON into pre-defined classes. This allows you to use type-hints and IDE autocompletion for your JSON data.

`eventjet/json` is loosely based how JSON in handled in Go's [`encoding/json`](https://pkg.go.dev/encoding/json) package.

## Installation
```bash
composer require eventjet/json
```

## Usage

```php
use Eventjet\Json\Json;

enum Status: string {
    case Active = 'active';
    case Inactive = 'inactive';
}

final readonly class User
{
    /**
     * @param list<User> $friends
     */
    public function __construct(
        public string $name,
        public Status $status,
        public array $friends,
        public string|null $email = null,
    ) {}
}

$json = '
    {
        "name": "John",
        "status": "active",
        "friends": [
            {"name": "Jane", "status": "inactive", "friends": []}
        ]
    }
';
$user = Json::decode($json, User::class);

echo $user->name; // John
echo $user->status; // Status::Active
echo $user->friends[0]->name; // Jane
echo $user->friends[0]->status; // Status::Inactive
```
