<?php


return [
    'client' => [
        'handler' => \Boddy\Mqtt\Client::class,
        'constructor' => [
            'config' => [
                'eventHandler' => plugin\boddy\mqtt\Events::class,
                'address' => 'mqtt://localhost:1883',
                'option' => [  // 配置
                    'username' => '',
                    'password' => '',
                    'client_id' => '',
                    'debug' => false,
                    'keepalive' => 50,
                    'protocol_name' => 'MQTT',
                    'protocol_level' => 4,
                    'clean_session' => true,
                    'reconnect_period' => 1,
                    'connect_timeout' => 30,
                    'resubscribe' => true,
                    'bindto' => '',
                    'ssl' => false,
                ],
            ]]
    ],
];
