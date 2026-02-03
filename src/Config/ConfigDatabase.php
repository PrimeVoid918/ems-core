<?php

namespace App\Config;

use App\Common\Utils\Env;
class ConfigDatabase
{
  public static function get(): array
  {
    return [
      'host' => Env::get('DB_HOST', 'localhost'),
      'dbname' => Env::get('DB_NAME'),
      'username' => Env::get('DB_USER'),
      'password' => Env::get('DB_PASS'),
    ];
  }
}

