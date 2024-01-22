<?php

namespace App\Http\Controllers;

use App\Models\User;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function webhook()
    {
        $updates = Telegram::getWebhookUpdate();
        $new_user = $updates['message']['from'];

        // find user in db
        $username = $new_user['username'];
        $user = User::where("telegram_username", $username)->first();

        // add user's id if it's correct
        if (isset($user->telegram_username)) {
            if ($user->is_telegram_id_verified === 1) {
                Telegram::sendMessage([
                    'chat_id' => $updates["message"]["chat"]["id"],
                    'text' => "Вы уже успешно верефицировали свой аккаунт 😃\. Ваш профиль здесь __https://kaxfgu\-ip\-73\-37\-205\-89\.tunnelmole\.net/dashboard__\.",
                    'parse_mode' => 'MarkdownV2'
                ]);
                return "succeeded_again";
            }

            $user->telegram_id = $new_user['id'];
            $user->is_telegram_id_verified = 1;
            $user->save();

            Telegram::sendMessage([
                'chat_id' => $updates["message"]["chat"]["id"],
                'text' => '*Спасибо вы успешно активировали свой аккаунт*\! Можете перейти по ссылке __https://xd4rps\-ip\-73\-37\-205\-89\.tunnelmole\.net/dashboard__\, либо перезагрузите страницу\.',
                'parse_mode' => 'MarkdownV2'
            ]);
            return "succeeded";
        }
        Telegram::sendMessage([
            'chat_id' => $updates["message"]["chat"]["id"],
            'text' => 'К сожалению\, предоставленный вами _Телеграм Никнейм_ не соответствует аккаунту с которого вы присали это сообщение\.',
            'parse_mode' => 'MarkdownV2'
        ]);
        return "failed";
    }

    public function setWebhook()
    {
        Telegram::setWebhook(["url" => config("services.telegram.webhook_url")]);
    }

    public function removeWebhook()
    {
        Telegram::removeWebhook();
    }
}
