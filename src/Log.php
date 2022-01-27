<?php

namespace Ronijan\Logger;

use JsonException;
use RuntimeException;

class Log
{
    /**
     * Path from vendor inside symfony or laravel project. This will be located at the root directory of the project.
     */
    public const DIR_STORAGE_LOGS = __DIR__ . '/../../../../storage/logs/';

    /**
     * @param mixed  $data
     * @param string $type
     * @param string $dir
     * @param string $sep
     * @param string $ext
     * @param bool   $startWithDateTime
     *
     * @throws JsonException
     * @return void
     */
    public static function add($data, string $type = 'Info', string $dir = '', string $sep = '_', string $ext = '.log', bool $startWithDateTime = false): void
    {
        if (is_object($data) || is_array($data)) {
            $data = str_replace(['[', ']', '"', '{', '}'], '', json_encode($data, JSON_THROW_ON_ERROR));
        }

        if ($dir === '') {
            $dir = self::makeDir();
        }

        $file = $dir . $type . $sep . date('Ymd_His') . $ext;
        $fp = fopen($file, "wb");

        if ($startWithDateTime === true) {
            $data = '# ' . date('Y-m-d H:i:s') . "\t" . $data;
        }

        fwrite($fp, $data);
        fclose($fp);
    }

    private static function makeDir(): string
    {
        if (!file_exists(self::DIR_STORAGE_LOGS)
            && !mkdir($concurrentDirectory = self::DIR_STORAGE_LOGS, 0777, true)
            && !is_dir($concurrentDirectory)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created.', $concurrentDirectory));
        }

        $file = self::DIR_STORAGE_LOGS;
        $gitignore = $file . '.gitignore';

        if (!is_file($gitignore)) {
            file_put_contents($gitignore, '*.log');
        }

        return $file;
    }
}
