<?php

namespace App\Cashbox\Models;

use Illuminate\Support\Facades\Redis;

class Manager
{
    public static function send($data = [])
    {
        Redis::publish('validator', json_encode([
            'action' => 'PROXY',
            'data' => $data
        ]));
    }
}
