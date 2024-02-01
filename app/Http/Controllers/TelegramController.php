<?php

namespace App\Http\Controllers;

use App\Models\User;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function webhook()
    {
        $updates = Telegram::getWebhookUpdate();

        // check if it's a primary chat - restrict if so.
        if (($updates['message']['chat']["title"] ?? null) === config("services.telegram.primary_chat_title")) {
            return;
        }

        $new_user = $updates['message']['from'];
        $url = str_replace(['-', '.'], ['\-', '\.'], config("services.website.url") . "dashboard");

        // find user in db
        $username = $new_user['username'];
        $user = User::where("telegram_username", $username)->first();

        // add user's id if it's correct
        if (isset($user->telegram_username)) {
            if ($user->telegram_id !== null) {
                Telegram::sendMessage([
                    'chat_id' => $updates["message"]["chat"]["id"],
                    'text' => "Вы уже успешно верефицировали свой аккаунт 😃\. Ваш профиль здесь __{$url}__\.",
                    'parse_mode' => 'MarkdownV2'
                ]);
                return "succeeded_again";
            }

            $user->telegram_id = $new_user['id'];
            $user->save();

            Telegram::sendMessage([
                'chat_id' => $updates["message"]["chat"]["id"],
                'text' => "*Спасибо вы успешно активировали свой аккаунт*\! Можете перейти по ссылке __{$url}__\, либо перезагрузите страницу\.",
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
        $url = config("services.website.url") . config("services.telegram.bot_token") . "/webhook";
        Telegram::setWebhook([
            "url" => $url
        ]);
    }

    public function removeWebhook()
    {
        Telegram::removeWebhook();
    }

    function isAdmin(string $chat_id, int $target_id)
    {
        // check if user is admin
        $admins = Telegram::getChatAdministrators([
            'chat_id' => $chat_id,
        ]);

        foreach ($admins as $admin) {
            if ($admin["user"]["id"] == $target_id) {
                return 1;
            }
        }
        return 0;
    }

    public function banChatMember(string $chat_id, int $user_id)
    {
        Telegram::banChatMember([
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        ]);
    }

    public function unbanChatMember(string $chat_id, int $user_id)
    {
        Telegram::unbanChatMember([
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'only_if_banned' => true,
        ]);
    }
}
