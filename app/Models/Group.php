<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'expire_hours'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'group_user',
            'group_id',
            'user_id'
        )->using(GroupUser::class);
    }

    public function expiredUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'group_user',
            'group_id',
            'user_id'
        )
            ->using(GroupUser::class)
            ->wherePivot('expired_at', '<', Carbon::now());
    }
}
