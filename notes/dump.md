src/
├── pages/
│   ├── auth/
│   │   ├── AuthLogin.php
│   │   ├── AuthSignup.php
│   │   └── AuthRoute.php
│   ├── admins/
│   ├── RootRoute.php
├── bootstrap/
│   └── App.php
├── config/
│   ├── ConfigEnvironment.php
│   └── ConfigDatabase.php
├── common/
│   ├── http/
│   ├── response/
│   └── utils/
├── domains/
│   ├── auth/
│   │   ├── AuthController.php
│   │   ├── AuthService.php
│   │   ├── AuthRepository.php
│   │   └── AuthEntity.php
│   ├── users/
│   └── bookings/
├── infrastructure/
│   ├── image/
│   │   ├── ImageService.php
│   │   └── ImageDto.php  
│   ├── database/
│   │   ├── DatabaseConnection.php
│   │   └── DatabaseQueryBuilder.php
│   └── persistence/
│       └── MysqlUserRepository.php
├── public/
│   └── index.php
└── routes/
    ├── ApiRoutes.php
    └── WebRoutes.php


| NestJS + Prisma            | Your PHP Architecture           |
| -------------------------- | ------------------------------- |
| `prisma.user.findUnique()` | `UserRepository::findByEmail()` |
| Prisma Client              | Repository implementation       |
| Prisma schema              | Entity / DTO                    |
| Service layer              | Service layer (same idea)       |
| Prisma types               | Entity / DTO                    |
| Prisma migrations          | SQL files / manual schema       |