<?php

// namespace App\Domains\Sample;
namespace App\Domains\Sample;

use App\Infra\Persistence\UsersRepository;

class SampleService
{
  public function findAll($firstname): array
  {
    $objectData = [
      "username" => $firstname,
      "message:" => "this is a findAll function",
      "isError" => true,
    ];

    return $objectData;
  }

  public function testCall(): array
  {
    $users = new UsersRepository();
    return [
      "data" => $users->findAll(),
    ];
  }

  public function compute($firstname, $lastname): string
  {
    return $firstname . $lastname;
  }
}
