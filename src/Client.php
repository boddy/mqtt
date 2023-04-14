<?php
namespace Boddy\Mqtt;

class Client
{
    protected $eventHandler = null;
    protected $config = [];
    protected $option = null;
    protected $address = null;


    public function __construct($config)
    {
        foreach ($config as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function onWorkerStart()
    {
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
        $mqtt = new \Workerman\Mqtt\Client($this->address, $this->option);
        foreach (['onConnect', 'onMessage', 'onClose', 'onError'] as $event) {
            if (method_exists($this->eventHandler, $event)) {
                $mqtt->$event = [$this->eventHandler, $event];
            }
        }
        $mqtt->connect();
    }

}
