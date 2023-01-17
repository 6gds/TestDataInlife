<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Group;

/**
 * Класс для работы с бизнесс-логикой связанной с группами
 */
class GroupService
{
    /**
     * Метод возвращает группу по id
     *
     * @param $groupId
     * @return Group
     */
    public static function getGroupById($groupId): Group
    {
        return Group::find($groupId);
    }

    public static function detachExpiredUsers(Collection $groups): void
    {
        $groups = Group::with('expiredUsers')->get();

        foreach ($groups as $group) {
            if (!$group->users()->detach($group->expiredUsers()->pluck('id')->get())) {
                throw new \Exception('Ошибка при удалении пользователя в группе');
            }
        }
    }
}
