<?php

namespace App\Pages\Home;

use App\Pages\Home\HomeController;
use App\Pages\Home\Settings\SettingsController;

class HomeRoute
{
  public static function routes(): array
  {
    return [
      '/' => HomeController::class,
      '/settings' => SettingsController::class,
    ];
  }
}
