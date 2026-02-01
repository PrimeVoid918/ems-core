<?php

namespace App\Domains\Sample;

class SampleController
{
  public function index(): void
  {
    $service = new SampleService();

    header('Content-Type: application/json');
    echo json_encode([
      'message' => $service->greet()
    ]);
  }
}
