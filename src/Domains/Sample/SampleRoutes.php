<?php

namespace App\Domains\Sample;

class SampleRoutes
{
  public static function routes(): array
  {
    return [
      'GET /' => [SampleController::class, 'index'],
      'POST /' => [SampleController::class, 'store'],
    ];
  }
}
