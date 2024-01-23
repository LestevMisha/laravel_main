<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Console\Command;
use App\Models\UsersTransactions;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class DecreaseLeftDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:decrease-left-days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(AuthService $authService)
    {
        // Decrement days_left for users with days_left greater than 0
        User::where("days_left", ">", 0)->decrement("days_left");

        // Find users with 1 days_left
        $usersWithOneDaysLeft = User::where("days_left", "=", 1)->get();

        // Find users with 0 days_left to cick
        $usersWithZeroDaysLeft = User::where("days_left", "=", 0)->get();

        // Log::error(User::where("days_left", ">", 0)->get());
        // Log::error($usersWithZeroDaysLeft);
        // Log::error($usersWithZeroDaysLeft->count());
        // Log::error("--------------- Well done ---------------");

        // 1. Step --0 days left-- ban/cick off user
        if ($usersWithZeroDaysLeft->count() > 0) {
            foreach ($usersWithZeroDaysLeft as $user) {
                $user = $user->first();
                $telegram_id = $user->telegram_id;
                // cick off user
                Telegram::banChatMember([
                    'chat_id' => '-1002083241184',
                    'user_id' => $telegram_id,
                ]);
            }
        }

        // 2. Step --1 day before cick-- try to make recurrent payment if user have enough balance
        if ($usersWithOneDaysLeft->count() > 0) {
            foreach ($usersWithOneDaysLeft as $user) {
                $user = $user->first();
                $uuid = $user->uuid;

                // Apply payment logic for each user with zero days_left
                $payment_method_id = UsersTransactions::where("uuid", $uuid)->first()->payment_method_id;
                $authService->getClient()->createPayment(
                    array(
                        'amount' => array(
                            'value' => 3000.0,
                            'currency' => 'RUB',
                        ),
                        'capture' => false,
                        'payment_method_id' => $payment_method_id,
                        'description' => "Auto-Recurrent payment 3K",
                        'metadata' => [
                            'uuid' => $uuid,
                            'isRecurrent' => true,
                        ]
                    ),
                    uniqid('', true)
                );
            }
            $this->info('Payment applied for users with zero days left.');
        }

        $this->info('Days subtracted successfully.');
    }
}
