### Logger

Composer install $ `composer require ronijan/logger`

```php

use Ronijan\Logger\Log;

$list = [
    'id' => 1,
    'name' => 'john doe',
    'url' => 'www.example.com'
];

Log::info($list); 

```
