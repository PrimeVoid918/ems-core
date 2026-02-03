<?php

namespace App\Common\Utils;

class Env
{
  private static bool $loaded = false;

  public static function load(string $path): void
  {
    if (self::$loaded || !file_exists($path)) {
      return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
      if (str_starts_with(trim($line), '#')) {
        continue;
      }

      [$key, $value] = explode('=', $line, 2);

      $key = trim($key);
      $value = trim($value, "\"' ");

      $_ENV[$key] = $value;
      putenv("$key=$value");
    }

    self::$loaded = true;
  }

  public static function get(string $key, mixed $default = null): mixed
  {
    return $_ENV[$key]
      ?? getenv($key)
      ?? $default;
  }
}
