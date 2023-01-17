<?php

namespace App\Console\Commands;

use App\Models\GroupUser;
use App\Models\User;
use App\Services\GroupService;
use App\Services\UserService;
use Illuminate\Console\Command;

class UserMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:member {--user=} {--group=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'user:member
                              {--user : The ID of the user}
                              {--group : The ID of the group}';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $userId = $this->option('user');
            $groupId = $this->option('group');

            $user = UserService::getUserById($userId);
            $group = GroupService::getGroupById($groupId);

            if (!empty($user) && !empty($group)) {
                UserService::addUserToGroup($user->id, $group->id);

                if (!$user->active) {
                    $user->active = true;

                    $user->save();
                }
            } else {
                throw new \Exception('Заданная группа или пользователь отсутствуют в системе');
            }
            dump('Всё прошло успешно');

            return Command::SUCCESS;
        } catch (\Exception $exception) {
            dump($exception);

            return Command::FAILURE;
        }
    }
}
