<?php

namespace Services;

use Models\User;

class UserService
{
    private static array $users = [];
    private static int $nextId = 1;

    public function getAll(): array
    {
        return array_values(self::$users);
    }

    public function getById(int $id): ?array
    {
        return self::$users[$id] ?? null;
    }

    public function create(array $data): array
    {
        $user = new User(
            self::$nextId++,
            $data['name']
        );

        self::$users[$user->id] = $user->toArray();
        return self::$users[$user->id];
    }
}
