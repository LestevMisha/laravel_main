<?php

namespace App\Services;

class TelegramService
{
    public function getLink($func, $uuid="none")
    {
        return "https://t.me/start_marathon_bot?start=" . $uuid . "_" . $func;
    }

    public function markdownv2($text)
    {
        $replacements = ['\\.', '\\<', '\\>'];

        // Add backslashes before periods and angle brackets
        $modifiedText = preg_replace_callback('/\.|<|>/', function ($matches) use ($replacements) {
            return $replacements[array_search($matches[0], ['.', '<', '>'])];
        }, $text);

        return $modifiedText;
    }
}
