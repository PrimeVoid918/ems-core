<?php

// namespace App\Domains\Sample;
namespace App\Domains\Sample;

class SampleService
{
  public function greet(): string
  {
    return 'Hello world test';
  }

  public function findAll($firstname): string
  {
    return $firstname;
  }

  public function compute($firstname, $lastname): string
  {
    return $firstname . $lastname;
  }
}
