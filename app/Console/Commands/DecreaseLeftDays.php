<?php

namespace App\Console\Commands;

use App\Http\Controllers\TelegramController;
use Exception;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Console\Command;
use App\Models\UsersTransactions;
use Illuminate\Support\Facades\Log;

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
        $this->info('Days subtracted successfully.');

        // Find users with 1 days_left
        $usersWithOneDaysLeft = User::where("days_left", "=", 1)->get();

        // Find users with 0 days_left to cick
        $usersWithZeroDaysLeft = User::where("days_left", "=", 0)->get();


        // 2. Step --1 day before cick-- try to make recurrent payment if user have enough balance
        if ($usersWithOneDaysLeft->count() > 0) {
            foreach ($usersWithOneDaysLeft as $user) {
                // Retrieve user's uuid
                $uuid = $user->uuid;

                // Retrieve user's transaction information
                $usersTransaction = UsersTransactions::where("uuid", $uuid)->first();

                // Set payment method ID to 0 if not available
                $payment_method_id = $usersTransaction->payment_method_id ?? 0;

                // If payment method ID is 0, return without further processing
                if ($payment_method_id === 0) {
                    continue;
                }

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

        // 1. Step --0 days left-- ban/cick off user
        if ($usersWithZeroDaysLeft->count() > 0) {
            foreach ($usersWithZeroDaysLeft as $user) {
                try {
                    $tg = new TelegramController();

                    // Main telegram group id
                    $telegram_group_id = config("services.telegram.group_id");

                    // User's telegram id
                    $telegram_id = $user->telegram_id;

                    // 1. check if user is not verified
                    if ($telegram_id === null) {
                        continue;
                    }

                    // 2. check if iser is admin
                    if ($tg->isAdmin((string)$telegram_group_id, (int)$telegram_id)) {
                        continue;
                    }

                    // if all checks are passed, kick user out
                    $tg->banChatMember((string)$telegram_group_id, (int)$telegram_id);
                } catch (Exception $error) {
                    Log::error($error);
                }
            }
        }
    }
}
