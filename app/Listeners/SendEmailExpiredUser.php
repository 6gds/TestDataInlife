<?php

namespace App\Listeners;

use App\Events\ExpiredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailExpiredUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ExpiredEvent  $event
     * @return void
     */
    public function handle(ExpiredEvent $event)
    {
        $email = $event->user->email;

        Mail::send(
            ["text"=>view('email.expired', ['user_name'=>$event->user->name, 'group_name'=> $event->group->name])],
            ["name"=>"ImagiNation", "mail"=>$email],
            function($message) use ($email) {
                $message->to($email, 'To u')->subject('Информация о отписки от группы');
                $message->from('denisgevor200@gmail.com', 'ImagiNation');
            }
        );
    }
}
