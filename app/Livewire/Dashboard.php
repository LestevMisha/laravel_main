<?php

namespace App\Livewire;

use App\Http\Controllers\TelegramController;
use Livewire\Component;
use App\Services\AuthService;
use App\Services\ModelService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Telegram\Bot\Laravel\Facades\Telegram;

use GuzzleHttp\Client;
use App\Models\UsersImages;

class Dashboard extends Component
{

    static function hasCardVerification()
    {
        $modelService = new ModelService();
        if ($modelService->getCardCredentials(Auth::user()->uuid)) {
            return true;
        }
        return false;
    }

    public function mount()
    {

        if (!Auth::check()) {
            return redirect()->route("login");
        }
        if (Auth::user()->telegram_id === null) {
            return redirect()->route("telegram.verify");
        }

        // !IMPORTANT It must be after user is logged in
        // open referral payment link if user was reffered
        // $authService = new AuthService();
        // if ($authService->isReferred()) {
        //     return redirect()->route("payment.referral");
        // }

        $modelService = new ModelService();
        $tgController = new TelegramController();
        if (!$modelService->hasImage()) {
            $bin_img = $tgController->observeImg(Auth::user()->telegram_id);
            $modelService->createImage(Auth::user()->uuid, $bin_img);
        }
        //     $resp = Telegram::getUserProfilePhotos([
        //         "user_id" => Auth::user()->telegram_id,
        //     ]);

        //     $link = Telegram::getFile([
        //         "file_id" => $resp["photos"][0][2]["file_id"],
        //     ]);

        //     $url = "https://api.telegram.org/file/bot" . config("services.telegram.bot_token") . "/" . $link["file_path"];

        //     $client = new Client();
        //     $response = $client->get($url);
        //     $imageData = $response->getBody()->getContents();

        //     $usersImage = new UsersImages([
        //         'uuid' => Auth::user()->uuid,
        //         'image_data' => $imageData,
        //     ]);

        //     $usersImage->save();
        // }

    }


    #[Layout("components.layouts.dashboard")]
    public function render()
    {
        return view("livewire.dashboard");
    }
}
