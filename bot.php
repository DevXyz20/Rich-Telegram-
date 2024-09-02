<?php
require 'vendor/autoload.php'; // تأكد من المسار الصحيح إلى autoload.php

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\InlineKeyboard\InlineKeyboard;

// تعيين معلومات البوت الخاصة بك
$API_KEY = '7519450817:AAF4ICG-mATU0eTzX4WOlmYcddK1kdtdMYo'; // أدخل مفتاح API الخاص بك هنا
$BOT_USERNAME = 'richmaneoeoekebot'; // أدخل اسم المستخدم الخاص بالبوت هنا

$telegram = new Telegram($API_KEY, $BOT_USERNAME);

// معالجة الأوامر
$telegram->addCommandClass(StartCommand::class);

// بدء البوت باستخدام Long Polling
try {
    $telegram->handle();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

class StartCommand extends Longman\TelegramBot\Commands\UserCommand
{
    protected $name = 'start';
    protected $description = 'Start command';
    protected $usage = '/start';
    protected $version = '1.0.0';

    public function execute()
    {
        $chat_id = $this->getMessage()->getChat()->getId();

        $keyboard = new InlineKeyboard([
            ['text' => 'Show proxies Servers', 'callback_data' => 'show_proxies'],
            ['text' => 'Show Smmpanel Prices Followers', 'callback_data' => 'show_prices']
        ]);

        $text = 'Welcome to Freeservice Server';

        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
            'reply_markup' => $keyboard,
        ];

        return Request::sendMessage($data);
    }
}
