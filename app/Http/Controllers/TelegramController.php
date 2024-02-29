<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    
    public function webhook()
    {
        $updates = Telegram::getWebhookUpdate();

        // get user's uuid
        $activation = $updates["message"]["text"];
        $activation_arr = explode(" ", $activation);
        $activation_key = $activation_arr[1];

        // observed user's data
        $new_user = $updates['message']['from'];

        // find user in db
        try {
            $user = User::where("uuid", $activation_key)->first();
        } catch (\Exception $e) {
            return;
        }

        // check if a user is a private chat member already
        try {
            $chatMember = Telegram::getChatMember([
                'chat_id' => config("services.telegram.group_id"),
                'user_id' => $new_user["id"],
            ]);
        } catch (\Exception $e) {
            // Set $chatMember to null in case of an error
            $chatMember = null;
        }

        if ($chatMember !== null) {
            // Get the current date
            $currentDate = new DateTime();

            // Get the last day of the current month
            $lastDayOfMonth = (new DateTime())->modify('last day of');

            // Calculate the number of days left
            $daysLeft = (int)$currentDate->diff($lastDayOfMonth)->days + 1;

            $user->days_left = $daysLeft;
        }

        // update user
        $user->telegram_id = $new_user['id'];
        $user->telegram_username = $new_user['username'];
        $user->save();

        Telegram::sendMessage([
            'chat_id' => $updates["message"]["chat"]["id"],
            'text' => "✅ Вход в личный кабинет выполнен\.",
            'parse_mode' => 'MarkdownV2'
        ]);
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
