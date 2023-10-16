<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class GreetingGenerator
{
    private LoggerInterface $logger;
    private string $lang;

    public function __construct(LoggerInterface $logger, string $lang="")
    {
        $this->logger = $logger;
        $this->lang = $lang;
    }

    public function getGreeting(): string
    {
        $messages_en = [
            "Hello",
            "Hi"
        ];
        $messages_ru = ["Привет", "Доброго времени суток"];

       $messages = match ($this->lang) {
            "en" => $messages_en,
           "ru" => $messages_ru,
           default =>array_merge($messages_en, $messages_ru)
        };

        $index = array_rand($messages);

        $greeting = $messages[$index];
        $this->logger->debug("Greeting generated: {0}", [$greeting]);
        return $greeting;
    }

}