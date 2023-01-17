<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Mail;

/**
 * Класс для работы с бизнесс-логикой связанной с отправкой сообщения по email
 */
class EmailService
{
    public static function sendMailToUser($email)
    {
        Mail::send(["text"=>"mail.subscribe"], ["name"=>"ImagiNation", "mail"=>$email], function($message) use ($email) {
            $message->to($email, 'To u')->subject('Информация о подписке');
            $message->from('denisgevor200@gmail.com', 'ImagiNation');
        });
    }
}
