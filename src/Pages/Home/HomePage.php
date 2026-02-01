<?php

namespace App\Pages\Home;

use App\Domains\Sample\SampleService;

class HomePage
{
  public function __invoke(): void
  {
    $service = new SampleService();
    echo $service->greet();
  }
}
