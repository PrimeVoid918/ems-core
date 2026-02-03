<?php

namespace App\Infra\Persistence;

use PDO;
use App\Infra\Database\DatabaseConnection;

class UsersRepository
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = DatabaseConnection::getInstance();
  }

  public function findAll(): array
  {
    $sql = "SELECT * FROM users";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
  }
}
