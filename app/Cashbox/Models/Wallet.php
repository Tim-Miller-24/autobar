<?php

namespace App\Cashbox\Models;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class Wallet
{
    const CHANNELS = [
        1000,
        5000,
        10000,
        50000,
        100000
    ];

    const TOTAL_SUM_KEY = 'validator.total_sum';

    const PUB_CHANNEL = 'validator';

    public static function getChannels()
    {
        return self::CHANNELS;
    }

    public static function getCurrentSum()
    {
        return (int) Cache::get(self::TOTAL_SUM_KEY, 0);
    }

    public static function addSum($value)
    {
        $sum = self::getCurrentSum() + (int) $value;

        Cache::forever(self::TOTAL_SUM_KEY, $sum);

        return self::getCurrentSum();
    }

    public static function reset()
    {
        Cache::forever(self::TOTAL_SUM_KEY, 0);
    }

    public static function send(array $data = [])
    {
        Redis::publish(self::PUB_CHANNEL, json_encode($data));
    }
}
