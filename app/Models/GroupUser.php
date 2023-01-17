<?php

namespace App\Models;

use App\Events\ExpiredEvent;
use App\Jobs\CheckHasUserGroupJob;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupUser extends Pivot
{
    use HasFactory;

    protected $table = 'group_user';

    protected $fillable = [
        'user_id',
        'group_id',
        'expired_at'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($groupUser) {
            $user = User::where('id', $groupUser->user_id)->first();
            $group = Group::where('id', $groupUser->group_id)->first();

            ExpiredEvent::dispatch($user, $group);

            dispatch(new CheckHasUserGroupJob($user));
        });
    }
}
