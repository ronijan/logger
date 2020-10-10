<?php

namespace Ronijan\Logger;

use DateTime;

class Log
{
    public static function info($data): void
    {
        $dateTime = new DateTime();
        $path = __DIR__ . '/../../../../storage/logs/';

        if (!mkdir($path, 0777, true) && !is_dir($path)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
        }

        $formatData = '# ' . $dateTime->format('Y-m-d H:i:s') . " \t " . serialize($data) . "\r\n";
        $file = $path . 'Log-' . date('m-d-yy') . '-' . md5(date("d")) . '.log';

        if (!file_put_contents($file, $formatData, FILE_APPEND | LOCK_EX)) {
            die('Failed to create Log file.');
        }

        file_put_contents($path . '.gitignore', '*.log');
    }
}
