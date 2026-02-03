<?php

namespace App\Domains\Sample;

class SampleRoutes
{
  public static function routes(): array
  {
    return [
      'GET /' => [SampleController::class, 'findAll'],
      'GET /testCall' => [SampleController::class, 'testCall'],
      'POST /' => [SampleController::class, 'create'],
    ];
  }
}
