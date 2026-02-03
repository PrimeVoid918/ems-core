<?php

namespace App\Infra\Database;

use PDO;
use PDOException;
use App\Config\ConfigDatabase;

class DatabaseConnection
{
  private static ?PDO $instance = null;

  private function __construct()
  {
  }
  private function __clone()
  {
  }

  public static function getInstance(): PDO
  {
    if (self::$instance === null) {
      $config = ConfigDatabase::get();

      // SAFE DEFAULTS
      $driver = 'mysql';
      $host = $config['host'];      // from .env
      $dbname = $config['dbname'];    // from .env
      $charset = 'utf8mb4';
      $port = '3306';

      $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";

      try {
        self::$instance = new PDO(
          $dsn,
          $config['username'],
          $config['password'],
          [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
          ]
        );
      } catch (PDOException $e) {
        throw new \RuntimeException(
          'Database connection failed: ' . $e->getMessage()
        );
      }
    }

    return self::$instance;
  }

}
