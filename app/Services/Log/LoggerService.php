<?php

namespace App\Services\Log;

use App\Models\History\History;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Telegram\Bot\Laravel\Facades\Telegram;
use Throwable;

class LoggerService
{
    public function telegram(string $message, ?int $chatId = null): void
    {
        $chatId = $chatId ?? config('telegram.base_chat_id');

        try {
            Telegram::setTimeout(5)->sendMessage([
                'chat_id' => $chatId,
                'text' => $message,
            ]);
        } catch (\Exception $e) {
            //
        }
    }

    public function logException(Throwable $exception): void
    {
        $message = $exception->getFile() . PHP_EOL . PHP_EOL;
        $message .= $exception->getMessage() . PHP_EOL;
        if ($exception instanceof MethodNotAllowedHttpException) {
            $message .= request()->getRequestUri();
        }

        $this->telegram($message);
    }

    public function database(array $message): void
    {
        $history = new History();
        $history->user_id = auth()->user()?->id;
        $history->ip = request()->getClientIp();
        $history->action = $message;
        $history->save();
    }

    public static function databaseStatic(array $message): void
    {
        $l = new self();
        $l->database($message);
    }
}
