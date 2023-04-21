<?php
namespace Boddy\Mqtt;

use Workerman\Worker;

class Client
{
    protected $eventHandler = null;
    protected $config = [];
    protected $option = null;
    protected $address = null;
    
    /**
     * mqtt类型，区分不同的渠道，如车厂，iot
     * @var null
     */
    protected $type = null;


    public function __construct($config)
    {
        foreach ($config as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function onWorkerStart(Worker $worker)
    {
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
        $mqtt = new \Workerman\Mqtt\Client($this->address, $this->option);
        $this->eventHandler::$type = $this->type;
        foreach (['onConnect', 'onMessage', 'onClose', 'onError'] as $event) {
            if (method_exists($this->eventHandler, $event)) {
                $mqtt->$event = [$this->eventHandler, $event];
            }
        }
        
        if (method_exists($this->eventHandler, 'onWorkerStart')) {
            call_user_func([$this->eventHandler, 'onWorkerStart'], $worker);
        } 
        $mqtt->connect();
    }

}
