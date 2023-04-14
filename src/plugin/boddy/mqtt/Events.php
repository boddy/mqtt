<?php

namespace plugin\boddy\mqtt;

use Workerman\Mqtt\Client;

class Events
{
    public static function onConnect(Client $mqtt)
    {
        echo "onConnect";
    }

    public static function onMessage($topic, $content, Client $mqtt)
    {
        echo "onMessage";
    }

    public static function onClose()
    {
        echo "onClose";
    }

    public static function onError(\Exception $e)
    {
        echo "onError";
    }

}
