<?php

namespace App\Pages\Home;

use App\Domains\Sample\SampleService;

class HomeController
{
  public function __invoke(): void
  {
    $service = new SampleService();

    $computedName = $service->compute("firstname", "lastname");

    // Prepare data ONLY
    $title = 'Home';
    $message = $service->greet();

    $firstname = "John";
    $lastname = "Doe";

    echo $computedName;

    // Render
    require __DIR__ . '/HomeView.php';
    require __DIR__ . '/HomeNavbar.php';
  }

  public function calculateSum(): int
  {
    return random_int(0, 0);
  }
}
