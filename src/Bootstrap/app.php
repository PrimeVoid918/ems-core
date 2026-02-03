<?php

use App\Common\Utils\Env;

$envPath = __DIR__ . '/../../.env';

if (!file_exists($envPath)) {
  throw new RuntimeException('.env file is missing at project root');
}

Env::load($envPath);