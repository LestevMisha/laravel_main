<?php

namespace App\Http\Controllers;

use DateTime;
use Throwable;
use App\Models\User;
use App\Services\TelegramService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{

    public function handle()
    {
        $update = Telegram::commandsHandler(true);
        $user_id = $update["message"]["from"]["id"];

        // check if user is registered on the website
        $user = User::where("telegram_id", $user_id)?->first();
        if ($user) {
            $message = $update["message"]["text"];

            if (strpos($message, "/changeEmail")) {
                $validator = Validator::make(["email" => $message], [
                    'email' => 'required|email|unique:users,email',
                ]);

                if ($validator->fails()) {
                    Telegram::sendMessage([
                        "chat_id" => $update["message"]["chat"]["id"],
                        "text" => $validator->errors()->first("email"),
                    ]);
                } else {
                    $user->email = $message;
                    $user->save();
                    Telegram::sendMessage([
                        "chat_id" => $update["message"]["chat"]["id"],
                        "text" => "✅ Отлично, мы заменили вашу почту!",
                    ]);
                }
            } else if ($message === "/changeEmail") {
                $tgService = new TelegramService();
                $text = $tgService->markdownv2("*$user->name* ваша текущая почта $user->email. Чтобы изменить текущюю почту напишите /changeEmail пробел <новая почта>, пример: `/changeEmail example@mail.ru.`");
                Telegram::sendMessage([
                    "chat_id" => $update["message"]["chat"]["id"],
                    "text" => $text,
                    "parse_mode" => "MarkdownV2",
                ]);
            } else {
                Telegram::sendMessage([
                    "chat_id" => $update["message"]["chat"]["id"],
                    "text" => "Доступные текущие комманды - /changeEmail",
                ]);
            }
        }
    }

    public function setWebhook()
    {
        $url = config("services.website.url") . "/1MIIJRAIBADANBgkqhkiG9w0BAQEFAASCCS4wggkqAgEAAoICAQC0dr14WFaDsDJsGvjxdCA8sD9GHD3/webhook";
        Telegram::setWebhook([
            "url" => $url
        ]);
    }

    public function removeWebhook()
    {
        Telegram::removeWebhook();
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

    public function observeImg($user_id)
    {
        // get user images
        $resp = Telegram::getUserProfilePhotos([
            "user_id" => $user_id,
        ]);

        // get path to last best-quality image
        $link = Telegram::getFile([
            "file_id" => $resp["photos"][0][2]["file_id"],
        ]);

        // return binary code of image
        $url = "https://api.telegram.org/file/bot" . config("services.telegram.bot_token") . "/" . $link["file_path"];
        $client = new Client();
        $response = $client->get($url);
        return $response->getBody()->getContents();
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
}
