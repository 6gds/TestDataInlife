<?php

namespace App\Console\Commands;

use App\Models\Group;
use Illuminate\Console\Command;

class UserCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check_expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $groups = Group::with('expiredUsers')->get();

            //Отправка почты и очередь отрабатывают в методе boot модели GroupUser
            foreach ($groups as $group) {
                $group->users()->detach($group->expiredUsers->pluck('id'));
            }

            dump('Всё прошло успешно');

            return Command::SUCCESS;
        } catch (\Exception $exception) {
            dump($exception);

            return Command::FAILURE;
        }

    }
}
