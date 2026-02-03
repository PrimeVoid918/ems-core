<?php

namespace App\Domains\Sample;

class SampleController
{
  public function findAll(): void
  {
    $service = new SampleService();

    header('Content-Type: application/json');
    echo json_encode([
      'message' => $service->findAll("sample username")
    ]);
  }

  public function testCall(): void
  {
    $service = new SampleService();

    header('Content-Type: application/json');
    echo json_encode([
      'message' => $service->testCall()
    ]);
  }

  public function create(): void
  {

  }
}
