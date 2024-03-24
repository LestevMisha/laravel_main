<?php

namespace App\Telegram\Commands;

use DateTime;
use App\Models\User;
use App\Services\TelegramService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Start Command to get you started';

    public function handle()
    {
        logger("start command");
        $updates = $this->getUpdate();
        $activation = $updates["message"]["text"];
        $new_user = $updates['message']['from'];
        $name = $new_user['first_name'] . " " . $new_user['last_name'];
        $id = $new_user["id"];


        try {
            $activation_key = explode(" ", $activation)[1];
            $user = User::where("uuid", $activation_key)->first();

            // Check if this telegram was used, if so REPLY
            if (User::where("telegram_id", $id)->exists()) {
                $this->replyWithMessage(['text' => "Хм.. 🤔 этот аккаунт уже был зарегестрирован, попробуйте войти в профиль тут 👉 https://misha.loca.lt/login"]);
                return;
            }

            // Check if user is already verified, if so REPLY
            if ($user->telegram_id !== null) {
                $this->replyWithMessage(['text' => "Ваш аккаунт уже вeрефицирован. 😎 Ваш профиль тут 👉 https://misha.loca.lt/dashboard"]);
                return;
            }
        } catch (\Exception $e) {
            // Check if user wasn't transferred, if so REPLY
            $this->replyWithMessage(['text' => "Хотите зрегестрироваться на Start Марафон? 😃 Перейдите по ссылке 👉 https://misha.loca.lt"]);
            return;
        }


        try {
            // if chatMember ($_) wasn't found throw an error
            $_ = Telegram::getChatMember([
                'chat_id' => config("services.telegram.group_id"),
                'user_id' => $id,
            ]);
            $daysLeft = (new DateTime())->diff((new DateTime())->modify('last day of'))->days + 1;
            $user->days_left = $daysLeft;
        } catch (\Exception $e) {
            // Handle exception if needed
        }


        // update user
        $user->telegram_id = $new_user['id'];
        $user->telegram_username = $new_user['username'];
        $user->save();

        $this->replyWithMessage(['text' => "✅ $name вы успешно верефицировали аккаунт. Ваш профиль тут 👉 https://misha.loca.lt/dashboard"]);
    }
}
