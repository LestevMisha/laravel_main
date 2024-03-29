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


        // try {
        //     // if chatMember ($_) wasn't found throw an error
        //     $_ = Telegram::getChatMember([
        //         'chat_id' => config("services.telegram.group_id"),
        //         'user_id' => $id,
        //     ]);
        //     $daysLeft = (new DateTime())->diff((new DateTime())->modify('last day of'))->days + 1;
        //     $user->days_left = $daysLeft;
        // } catch (\Exception $e) {
        //     // Handle exception if needed
        // }


        // update user
        $user->telegram_id = $new_user['id'];
        $user->telegram_username = $new_user['username'];
        $user->save();
        $this->replyWithMessage(['text' => "✅ $name Поздравляю! Вы участник клуба!

Сперва читаем все внимательно и до конца! Потом перечитываем ещё раз и следуем инструкции по порядку!

Ниже представлены ссылки на архивные месяца клуба. Месяц «Клуб старт» сейчас самый актуальный! Подпишитесь сразу на него ! И слушайте все месяца по порядку.

Информация в них добавляется в реальном времени! То есть это самая важная для вас сейчас информация!

Первый месяц
t.me/joinchat/iSvEeQpRY5QzYzJi
(не актуально) 

Второй месяц
t.me/joinchat/QSoelrVPzhgxOTIy

Третий месяц
t.me/joinchat/KiHH4S2A2MMyYWZi

Четвёртый месяц
t.me/joinchat/eH9O3giE__g3NTRi

Пятый месяц
t.me/+6SvcMQ-eU2UxYjJi

Декабрь 2021
t.me/+pd_DVCaBCEQzNzNi

Январь 2022
t.me/+7NS5ZKL7UhQ0NDIy

Февраль 2022
t.me/+ZaYCRNW5oH8zYjQy

Март 2022
t.me/+-83yORuKzIY0NWYy

Апрель 2022
t.me/+Y8lVy6J3K6M4NTMy

Май 2022
t.me/+bD_9IfGxb-84ZWVi

Июнь 2022
t.me/+nfX4dBlo8FwxMjUy

Июль 2022
t.me/+J_Fx3DLDTYEzY2Ji

Август 2022
t.me/+xexjQKCVERU4MTEy

Сентябрь 2022
t.me/+97FeUmVWwwo2ZTI6

Октябрь
t.me/+X1aMdiIY6S41YWVi

Ноябрь 
t.me/+ecRUOX8sn_U1MTli

Декабрь
t.me/+fOqkj8wbJQBmZmQy

Январь 2023
t.me/+GjhMWJI2AGdhZWYy

Февраль 2023
t.me/+YZCeqH07KxY4MmRi

Март 2023
t.me/+ucaGfcj3NG5lYTUy

Апрель 2023
t.me/+af7cmW6fxPIwNDUy

Май 2023
t.me/+xWNcvRIZ6BdmNTky

Июнь 2023
t.me/+dZh4ACD7RrhhYmMy

Июль 2023
t.me/+hebZJtUGP1g5MmIy

Клуб Старт
t.me/+rY51umjdcC4wODMy
(Нужно подать заявку) 

Внимание! На все каналы необходимо сразу подписаться. Слушайте по порядку все на скорости 2х. Все месяца нужно прослушать за 2-4 дня! Это самое главное сейчас задание!

Важно! Некоторые темы в клубе потеряли свою актуальность. Например, что нужно создавать 2 аккаунта. Уже не нужно! То есть.. то что вы изучали на марафоне, была самая новая информация. Но несмотря на это, все равно все месяца нужно прослушать на 2х !

Огромная рекомендация все прослушать залпом за максимально быстрое время! Чтобы новая информация не навалилась на вас как снежный ком. Всю новую информацию в клубе слушайте сразу! Чтобы вам сейчас сделать много продаж пока сезон!

Бот для оформления заказов: @poshagamshop_bot

Видео руководство по использованию бота - youtube.com/watch?v=jd1qkLb99Sw&si=EnSIkaIECMiOmarE

Помощник который помогает обрабатывать заказы по дроппу Сергей. 

Его Телеграм: @poshagam_info
Писать строго на этот аккаунт⬆️

Заказы все можете также присылать ему или через бот.

Каждый поток марафона действует правило! 1 участник на 1 город. В следующем потоке возможно будет новый партнёр! Поэтому у вас есть целый месяц на то, чтобы раскачать свой магазин и стать номером 1 в своём городе! Напоминаю что никто вам не запрещает работать и по другим городам тоже! 

Внимание! Вот мой личный аккаунт для связи: @akprivatee Сообщение мне можно писать только после того, как прослушаете все месяца в Телеграм! Также по заданиям писать уже не нужно! Они уже не актуальны!

Писать слова благодарности тоже не нужно! Это отвлекает меня от работы! Прошу отнестись с понимаем!

Нельзя никому писать из клуба и отвлекать от работы!

Возврат за клуб мы не делаем! Услуга считается оказанной, как только вам выслали доступ!

За нарушение правил вы можете быть исключены из клуба!

Приступайте к работе сразу и не откладывайте! Развития вам! )) 😉
        "]);
        $this->replyWithMessage(['text' => "Доступ в клуб START ✅ - https://t.me/+U86N3fnqA7wzM2Vl"]);
    }
}
