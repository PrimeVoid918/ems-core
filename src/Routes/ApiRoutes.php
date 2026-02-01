<?php

use App\Domains\Sample\SampleController;

return [
  'GET /api/sample' => [SampleController::class, 'index'],
];
