<?php

namespace Ronijan\Logger;

use RuntimeException;

class Log
{
    public const DIR = __DIR__ . '/../../../../storage/logs/';

    public function __construct()
    {
        $this->gitignore();
    }

    public static function info($data): void
    {
        $file = 'Info-' . date('m.Y') . '-' . md5(date("m")) . '.log';
        self::createFile($file);

        $date = date('d.m.Y h:i:s');
        $log = '# ' . $date . "\t" . print_r($data, true) . "\n";
        error_log($log, 3, self::DIR . $file);
    }

    public static function debug($data): void
    {
        $file = 'Debug-' . date('m.Y') . '-' . md5(date("m")) . '.log';
        self::createFile($file);

        $date = date('d.m.Y h:i:s');
        $log = '# ' . $date . "\t" . print_r($data, true) . "\n";
        error_log($log, 3, self::DIR . $file);
    }

    public static function emergency($data): void
    {
        $file = 'Emergency-' . date('m.Y') . '-' . md5(date("m")) . '.log';
        self::createFile($file);

        $date = date('d.m.Y h:i:s');
        $log = '# ' . $date . "\t" . print_r($data, true) . "\n";
        error_log($log, 3, self::DIR . $file);
    }

    private function gitignore(): void
    {
        if (!file_exists(self::DIR) && !mkdir($concurrentDirectory = self::DIR, 0777,
                true) && !is_dir($concurrentDirectory)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }

        $file = self::DIR . '.gitignore';
        self::createFile($file);

        if (!is_file($file)) {
            file_put_contents($file, '*.log');
        }
    }

    private static function createFile(string $file): void
    {
        if (!is_file($file)) {
            file_put_contents($file, '');
        }
    }
}
