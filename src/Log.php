<?php

namespace Ronijan\Logger;

use DateTime;

class Log
{
  /**
  * @param string|mixed|array|object $data
  * @return bool
  */
  public static function info($data)
  {
    $path = __DIR__ . '/../../../../storage/logs/';

    if (! is_dir($path)) {
      mkdir($path, 0777, true);
    }

    if (!is_array($data)) {
      $formatData = self::formattedData($data);
    }else {
      foreach ($data as $value) {
        $formatData = self::formattedData($value);
      }
    }

    $file = $path . 'Log-' . date('m-d-yy') . '-' . md5(date("d")) . '.log';

    if (! file_put_contents($file, $formatData, FILE_APPEND | LOCK_EX)) {
      die('Failed to create Log file.');
    }
  }

  /**
  * @param string|mixed|array|object $data
  * @return string
  */
  public static function formattedData($data)
  {
    $dateTime = new DateTime();

    return '# ' . $dateTime->format('Y-m-d H:i:s') . "\t" . $data . "\r\n";
  }
}
