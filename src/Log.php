<?php

namespace Ronijan\Logger;

use DateTime;

class Log
{
    /**
     * @param mixed $data
     */
    public static function info($data)
    {
        $dateTime = new DateTime();
        $path = __DIR__ . '/../../../../storage/logs/';

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $formatData = '# ' . $dateTime->format('Y-m-d H:i:s') . " \t " . serialize($data) . "\r\n";

        $file = $path . 'Log-' . date('m-d-yy') . '-' . md5(date("d")) . '.log';

        if (!file_put_contents($file, $formatData, FILE_APPEND | LOCK_EX)) {
            die('Failed to create Log file.');
        }

        file_put_contents($path . '.gitignore', '*.log');
    }
}
