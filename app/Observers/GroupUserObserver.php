<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\GroupUser;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class GroupUserObserver
{
    /**
     * Handle the GroupUser "saving" event.
     *
     * @param  \App\Models\GroupUser  $groupUser
     * @return void
     */
    public function saving(GroupUser $groupUser): void
    {
        $expireHours = Group::find($groupUser->group_id)->expire_hours;

        $groupUser->expired_at = CarbonImmutable::now()->add($expireHours, 'hour');
    }
}
