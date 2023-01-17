<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Group;
use App\Models\User;

/**
 * Класс для работы с бизнесс-логикой связанной с пользователями
 */
class UserService
{
    /**
     * Метод возвращает пользователя по id
     *
     * @param $userId
     * @return User
     */
    public static function getUserById($userId): User
    {
        return User::find($userId);
    }

    /**
     * Метод добавляет пользователя в группу
     *
     * @param int $userId
     * @param int $groupId
     * @return void
     */
    public static function addUserToGroup(int $userId, int $groupId): void
    {
        $user = User::find($userId);
        $group = Group::find($groupId);

        $group->users()->attach($userId);
    }
}
