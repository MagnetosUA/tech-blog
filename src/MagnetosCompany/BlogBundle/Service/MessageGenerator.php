<?php

namespace MagnetosCompany\BlogBundle\Service;


class MessageGenerator
{
    public $messages = [
        'Give a man a match, and he\'ll be warm for a minute, but set him on fire, and he\'ll be warm for the rest of his life.',
        'The real trouble with reality is that there\'s no background music.',
        'Going to church doesn\'t make you a Christian any more than standing in a garage makes you a car.',
        'Everyone is entitled to be stupid, but some abuse the privilege.',
    ];

    public function getRandomMessage()
    {
        $index = array_rand($this->messages);
        $message = $this->messages[$index];
        return $message;
    }

}