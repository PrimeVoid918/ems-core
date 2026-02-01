## Users repository
```php
<?php

namespace App\Domains\Users; // <- user entities

interface UserRepository
{
    public function findById(int $id): ?UserEntity;
    public function findByEmail(string $email): ?UserEntity;
    public function save(UserEntity $user): UserEntity;
}

```
“What data operations does the domain need?”

## Domain Entity
```php
<?php

namespace App\Domains\Users;

class UserEntity
{
    public function __construct(
        public ?int $id,
        public string $email,
        public string $passwordHash
    ) {}
}

```

## Infrastructure: MySQL implementation
```php
<?php

namespace App\Infrastructure\Persistence;

use PDO;
use App\Domains\Users\UserRepository;
use App\Domains\Users\UserEntity;

class MysqlUserRepository implements UserRepository
{
    public function __construct(private PDO $db) {}

    public function findById(int $id): ?UserEntity
    {
        $stmt = $this->db->prepare(
            "SELECT id, email, password FROM users WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new UserEntity(
            id: (int)$row['id'],
            email: $row['email'],
            passwordHash: $row['password']
        );
    }

    public function findByEmail(string $email): ?UserEntity
    {
        $stmt = $this->db->prepare(
            "SELECT id, email, password FROM users WHERE email = :email"
        );
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new UserEntity(
            id: (int)$row['id'],
            email: $row['email'],
            passwordHash: $row['password']
        );
    }

    public function save(UserEntity $user): UserEntity
    {
        $stmt = $this->db->prepare(
            "INSERT INTO users (email, password) VALUES (:email, :password)"
        );
        $stmt->execute([
            'email' => $user->email,
            'password' => $user->passwordHash
        ]);

        $user->id = (int)$this->db->lastInsertId();
        return $user;
    }
}
```

## Domain Service:
```php
<?php

namespace App\Domains\Auth;

use App\Domains\Users\UserRepository;

class AuthService
{
    public function __construct(
        private UserRepository $users
    ) {}

    public function login(string $email, string $password)
    {
        $user = $this->users->findByEmail($email);

        if (!$user || !password_verify($password, $user->passwordHash)) {
            throw new \Exception("Invalid credentials");
        }

        return $user;
    }
}

```