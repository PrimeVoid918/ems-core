<?php

// namespace App\Domains\Sample;
namespace App\Persistence;

class UsersRepository
{
  public function findAll(): array
  {
    $sql = "SELECT * FROM users";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt;
  }
}
